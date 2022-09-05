<?php
namespace System\Core;

use Attribute;

#[Attribute]
class Route {

    public function __construct(
        public string $type,
        public string $route,
        public $headers = [],
        public $requireHeader = [],
        public $onCallBefore = [],
        public $onCallAfter = [],
        public $onCallFinish = []
    ) {
    }


}