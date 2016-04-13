<?php namespace App\Http;

class Flash
{

    /**
     * @param        $title
     * @param        $message
     * @param        $level
     * @param string $key
     *
     * @return mixed
     */
    public function create($title, $message, $level, $key ='flash_message')
    {
        return session()->flash($key, [
            'title'   => $title,
            'message' => $message,
            'level'   => $level
        ]);
    }


    /**
     * @param $title
     * @param $message
     *
     * @return mixed
     */
    public function info($title, $message)
    {
        return $this->create($title, $message, 'info');
    }


    /**
     * @param $title
     * @param $message
     *
     * @return mixed
     */
    public function success($title, $message)
    {
        return $this->create($title, $message, 'success');
    }


    /**
     * @param $title
     * @param $message
     *
     * @return mixed
     */
    public function error($title, $message)
    {
        return $this->create($title, $message, 'error');
    }


    /**
     * @param        $title
     * @param        $message
     * @param string $level
     *
     * @return mixed
     */
    public function overlay($title, $message, $level = 'success')
    {
        return $this->create($title, $message, $level, 'flash_message_overlay');
    }
}

// $flash->message('Hello There');
// $flash->error('Hello There');
// $flash->aside('Hello There');
// $flash->overlay('Hello There');
// $flash->success('Hello There');