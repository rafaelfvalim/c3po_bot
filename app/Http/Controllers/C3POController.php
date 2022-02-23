<?php

namespace App\Http\Controllers;

use App\Classes\C3POBot;
use App\Models\Params;
use Illuminate\Http\Request;


class C3POController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sapBlogFeedToTelegram($link, $qtemensagens, $grupo)
    {
        $url = Params::where('chave', $link)->get()->first();
        C3POBot::sapBlogFeedToTelegram($url->valor, $qtemensagens, $grupo);
    }

    public function youtubeFeed($grupo, $channelId)
    {
        C3POBot::youtubeFeedToTelegram($grupo, $channelId);
    }

    public function telegramUserCount($grupo)
    {
        C3POBot::telegramUserCount($grupo);
    }

    public function reportCliquesAabapDojo()
    {
        C3POBot::reportClicks('@abap_dojo', 'rafael.figueiredo.valim@gmail.com');
    }

    public function reportCliquesLeoAbap()
    {
        C3POBot::reportClicks('@leoabap', 'leonardonobre@gmail.com');
    }
    
    

}
