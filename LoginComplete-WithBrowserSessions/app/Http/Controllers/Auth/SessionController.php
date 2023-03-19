<?php

namespace App\Http\Controllers\Auth;

use Anubra266\BrowserSessions\BrowserSessions;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class SessionController extends Controller
{

    //Get a collection of sessions
    public function showSessions(Request $request){
        // This method accepts the request instance
        $sessions = collect(DB::table(config('session.table', 'sessions'))
                ->where('user_id', $request->user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get())
                ->map(function ($session){
                    return (object)$this->sessionList($session);
                });
        //Pass the collection to your view
        return view('auth/sessions', ["sessions" => $sessions->all()]);
    }

    public function sessionList($session)
    {
        $agent = $this->createAgent($session);
        return  [
            'key' => $session->id,
            'agent' => (object)[
                'is_desktop' => $agent->isDesktop(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
            ],
            'ip_address' => $session->ip_address,
            'is_current_device' => $session->id === request()->session()->getId(),
            'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
        ];
    }

    /**
     * Create a new agent instance from the given session.
     *
     * @param  mixed  $session
     * @return \Jenssegers\Agent\Agent
     */
    protected function createAgent($session)
    {
        return tap(new Agent(), function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });
    }
}
