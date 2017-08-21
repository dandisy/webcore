<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class WebCore extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        if(preg_match('/\[([^\[]+)\]/', $this->config['pageContent'], $match)) {
            $this->config['pageContent'] = preg_replace_callback('/\[([^\[]+)\]/', function ($matches)
            {
                foreach($matches as $match) {
                    $dataRef = substr($match, 1, -1);
                    $dataRef = strip_tags($dataRef);
                    $dataRef = preg_replace("/&#?[a-z0-9]{2,8};/i","",$dataRef);
                    $dataRef = preg_replace('/\s+/', '', $dataRef);

                    $widgetData = NULL;
                    $arr = explode(',', $dataRef);
                    foreach($arr as $val) {
                        $item = explode('=', $val);
                        $widgetData[$item[0]] = $item[1];
                    }
                    $model = '\App\Models\Admin\\' . $widgetData['source'];

                    $widgetContent = NULL;
                    if($widgetData['where']) {
                        $cond = explode(':', $widgetData['where']);
                        $widgetContent = $model::where($cond[0], $cond[1])->paginate(10);
                    } else {
                        $widgetContent = $model::paginate(10);
                    }

                    return view('widgets.'.$widgetData['widget'], [
                        'widgetContent' => $widgetContent,
                    ]);
                }
            }, $this->config['pageContent']);
        }

        return $this->config['pageContent'];
    }
}
