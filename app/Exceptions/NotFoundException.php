<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $HTTP_ERROR = 404;
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json(['status' => $this->HTTP_ERROR, 'message' => $this->getMessage()], $this->HTTP_ERROR);
    }
}
