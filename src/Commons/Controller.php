<?php

namespace App\StoreShoe\Commons;

use eftec\bladeone\BladeOne;

class Controller {
    public function renderViewsClient($view, $data = [])
    {
        $views = __DIR__ . '/../views/Client';
      
        $blade = new BladeOne($views); // MODE_DEBUG allows to pinpoint troubles.
        echo $blade->run($view, $data); // it calls /views/hello.blade.php
    }

        public function renderViewsAdmin($view, $data = [])
        {
            $views = __DIR__ . '/../views/Admin';

            $blade = new BladeOne($views); // MODE_DEBUG allows to pinpoint troubles.
            echo $blade->run($view, $data); // it calls /views/hello.blade.php
        }
}

