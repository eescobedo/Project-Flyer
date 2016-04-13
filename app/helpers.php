<?php

function flash($title = null, $message = null)
{
    //return session()->flash('flash_message', $message); -- old form
    $flash = app('App\Http\Flash');

    if (func_num_args() == 0) {
        return $flash;  // $flash->success()
    }

    return $flash->info($title, $message);  // flash()->success('Title', 'Body');
}