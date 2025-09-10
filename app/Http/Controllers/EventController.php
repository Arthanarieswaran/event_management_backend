<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class EventController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search  = $request->query('search');

        $now   = now()->toDateTimeString();
        $event = Event::where('start_time', '>', $now);

        if ($search) {
            $event = $event->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', '%' . $search . '%')
                    ->orWhere('location', 'ILIKE', '%' . $search . '%');
            });
        }

        $event = $event->withCount('attendees')->orderBy('start_time')->paginate($perPage);

        return $this->sendResponse($event, 'event fetched successfully');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'start_time'   => 'required|date',
            'end_time'     => 'required|date|after:start_time',
            'max_capacity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return $this->sendValidateError($validator->errors());
        }

        $startTime = Carbon::parse($request['start_time'], config('app.timezone'))->setTimezone('UTC');
        $endTime   = Carbon::parse($request['end_time'])->setTimezone('UTC');

        $event = Event::create([
            'name'         => $request['name'],
            'location'     => $request['location'],
            'start_time'   => $startTime,
            'end_time'     => $endTime,
            'max_capacity' => $request['max_capacity'],
        ]);

        return $this->sendResponse($event, 'Event created succeesfully');
    }
}
