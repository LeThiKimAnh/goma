<?php
namespace App\Jobs;

use App\Jobs\Panel;

class Optimzer {
    protected $recyclees;
    protected $currentPanel;
    protected $usingPanels;
    protected $rects;
    
    public function __construct($recyclees, $rects) {
        $this-> recyclees = $recycleess;
        $this-> rect = $rects;
    }
    
    public function run() {
        // sort all the rect by area desc
        usort($this->rects, function($rect1, $rect2) {
            return $rect2->area - $rect1->area;
        });
        
        foreach($this->recyclee as $r) {
            $panel = new Panel($r->width, $r->height, $r->requirement);
        }
        
    }
}
