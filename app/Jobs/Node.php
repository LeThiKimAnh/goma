<?php

class Node {
    protected $width;
    protected $height;
    
    protected $code;
    protected $color;
    
    protected $left;
    protected $right;
    protected $filled;
    
    public function __construct() {
        
    }
    
    public function insert($rect) {
        if($this->left != null) {
            return $this->left->insert($rect) || $this->right->insert($rect);
        }
        
        if($this->filled) {
            return False;
        }
        
        $ww_rate = $rect->width / $this->width;
        $hh_rate = $rect->height / $this->height;
        
        if($ww_rate > 1 or $$hh_rate > 1) {
            if($rect->req == 0) {
                // rotate if need, get optimize scale
                $wh_rate = $rect->width / $this->height;
                $hw_rate = $rect->height / $this->width;
            
                if($wh_rate > 1 or $$hw_rate > 1) {
                    // it will not fit any way => try to figure it out the best rate
                    return False;
                }
                $rect -> rotate = True;
            }
            
            return False;
        }
        # TODO it will fit, chose the best way to rotate
        
    }
}
