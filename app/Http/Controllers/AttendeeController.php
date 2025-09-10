<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Event;
use Illuminate\Http\Request;
use Validator;

class AttendeeController extends BaseController
{
    public function register(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        if ($event->attendees()->count() >= $event->max_capacity) {
            return $this->sendError('Event full');
        }

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        if ($event->attendees()->where('event_id', $eventId)->where('email', $request['email'])->exists()) {
            return $this->sendError('Duplicate registration');
        }

        $attendee = $event->attendees()->create($request->all());
        return $this->sendResponse($attendee, 'Event registration confirmed.');
    }

    public function list(Request $request, $eventId)
    {
        $perPage = $request->query('per_page', 10);
        $search  = $request->query('search');

        $event = Event::findOrFail($eventId)->attendees();

        if ($search) {
            $event = $event->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', '%' . $search . '%')
                    ->orWhere('email', 'ILIKE', '%' . $search . '%');
            });
        }

        $event = $event->paginate($perPage);

        $response = [
            'event_name' => Event::where('id', $eventId)->value('name'),
            'event'      => $event,
        ];

        return $this->sendResponse($response, 'Events');
    }
}
