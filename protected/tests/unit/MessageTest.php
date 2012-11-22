<?php
Yii::import('application.controllers.MessageController');
class MessageTest extends CTestCase
{
    public function repeat($inputString)
    {
        return $inputString;
    }

    public function testRepeat()
    {
        $message = new MessageController('messageTest');
        $this->assertEquals($this->repeat("Any One Out There?"),"Any One Out There?");
    }
}
