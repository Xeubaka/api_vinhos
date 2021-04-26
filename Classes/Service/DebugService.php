<?php
// phpcs:disable PEAR.Commenting
// phpcs:disable Generic.Files.LineLength.TooLong
namespace service;

class DebugService
{
    public function consoleLog($output, $with_script_tags = true)
    {
        $js_code = 'console.log('.json_encode($output, JSON_HEX_TAG) .');';
        if ($with_script_tags) {
            $js_code = '<script>'.$js_code.'</script>';
        }
        echo $js_code;
    }

    /*
        $DebugService = new DebugService;
        $DebugService->consoleLog($msg);
    */
}

?>
