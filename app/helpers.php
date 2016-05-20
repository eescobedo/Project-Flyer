<?php

use App\Flyer;

function flash($title = null, $message = null)
{
    //return session()->flash('flash_message', $message); -- old form
    $flash = app('App\Http\Flash');

    if (func_num_args() == 0) {
        return $flash;  // $flash->success()
    }

    return $flash->info($title, $message);  // flash()->success('Title', 'Body');
}

/**
 * The path to a given flyer.
 *
 * @param Flyer $flyer
 *
 * @return string
 */
function flyer_path(Flyer $flyer)
{
    return $flyer->zip . '/' . str_replace(' ', '-', $flyer->street);
}

// link_to ('Delete?', $model, 'DELETE')
// link_to ('Delete?', '/photos/1/delete', 'DELETE')
function link_to($body, $path, $type)
{

    if (is_object($path)) {
        // $photo, DELETE --> DELETE /photos/id
        $action = '/' .$path->getTable(); // photos

        if (in_array($type, ['PUT', 'PATCH', 'DELETE'])) {
            $action .= '/' . $path->getKey(); // photos/1
        }
    } else {
        $action = $path;
    }


    $csrf = csrf_field();

    return <<<EOT
        <form method="POST" action="{$action}">
            <input type='hidden' name='_method' value='{$type}'>
                $csrf
            <button type="submit">{$body}</button>
       </form>


EOT;

}
