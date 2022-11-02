<?php

namespace Encore\Admin\CustomLogViewer;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomLogController extends Controller
{
    public function index(Request $request, $file = null)
    {
        if ($file === null) {
            $file = (new CustomLogViewer())->getLastModifiedLog();
        }

        return Admin::content(function (Content $content) use ($file, $request) {
            $offset = $request->get('offset');

            $viewer = new CustomLogViewer($file);

            $content->body(view('laravel-admin-logs::logs', [
                'logs'      => $viewer->fetch($offset),
                'logFiles'  => $viewer->getLogFiles(),
                'fileName'  => $viewer->file,
                'end'       => $viewer->getFilesize(),
                'tailPath'  => route('custom-log-viewer-tail', ['file' => $viewer->file]),
                'prevUrl'   => $viewer->getPrevPageUrl(),
                'nextUrl'   => $viewer->getNextPageUrl(),
                'filePath'  => $viewer->getFilePath(),
                'size'      => static::bytesToHuman($viewer->getFilesize()),
            ]));

            $content->header($viewer->getFilePath());
        });
    }

    public function tail(Request $request, $file)
    {
        $offset = $request->get('offset');

        $viewer = new CustomLogViewer($file);

        list($pos, $logs) = $viewer->tail($offset);

        return compact('pos', 'logs');
    }

    protected static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2).' '.$units[$i];
    }
}
