<?php


class Page
{
    public function indexAction()
    {
        echo "Page - ALL fine";
    }

    public function testAction()
    {
        echo "test - ALL fine";
    }

    public function testPageAction()
    {
        echo "testPage - ALL fine";
    }
    public function before()
    {
        echo "before - ALL fine";
    }
}