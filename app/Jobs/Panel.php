<?php
namespace App\Jobs;

class Panel {
    private $root;
    
    public $width;
    public $height;
    public $area;
    public $req;
    
    private $filledArea = 0;
    private $root;
    
    public function __construct($width, $height, $req) {
        $this->width = $width;
        $this->height = $height;
        $thus->req = $req;
        
        $this->area = $width * $height;
        $this->root = new Node($width, $height, $req);
    }
    
    public function tryAdd($rects) {
        foreach ($rects as $rect) {
            if($this->root->insert($rect)) {
                $this->filledArea += $rect->area;
            }
            // TODO remove this rect from list
        }
        return $rects;
    }
    
    public function genSketch() {
        // TODO generate the sketch as a string
    }
    
    public function draw() {
        // TODO iterate from root and draw it all to a buffer image
    }
}
