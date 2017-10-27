<?php

namespace src\CINF\Generator;

class Entrance
{
    const ENTRANCE_PATH = ROOT_DIR . 'entrance' . DIRECTORY_SEPARATOR;

    protected $name = '';

    protected static $requires = [
        'base'
    ];

    /**
     * Entrance constructor.
     *
     * @param string $name
     *   Entrance name.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function generate()
    {
        if (!$this->name) {
            throw new \Exception("Entrance name cannot be empty.");
        }
        if (!is_string((string) $this->name)) {
            throw new \TypeError("Entrance name value should be string. " . gettype($this->name) . " gotten.");
        }

        $entranceDir = static::ENTRANCE_PATH;
        $path = $entranceDir . $this->name . '.php';

        if (file_exists($path)) {
            throw new \Exception("Entrance {$this->name} already exists.");
        }

        $tree = explode('/', $this->name);
        $file = array_pop($tree);


        foreach ($tree as $dir) {
            $entranceDir .= $dir . DIRECTORY_SEPARATOR;
            if (!is_dir($entranceDir)) {
                mkdir($entranceDir, 0775, true);
            }
        }

        $result = file_put_contents($entranceDir . $file . '.php', $this->getContent(count($tree)));

        if (!$result) {
            throw new \Exception("Entrance cannot be created.");
        }
    }

    /**
     * Entrance content.
     *
     * @param integer $dept
     *
     * @return string
     */
    protected function getContent($dept)
    {
        $content = "<?php\n\n";

        foreach ($this->getRequires($dept) as $file) {
            $content .= "require_once '" . $file . "';\n";
        }

        $content .= "\n// Script...\n";

        return $content;
    }

    protected function getRequires($dept)
    {
        $path = '';
        $requires = [];

        while (1 + $dept--) {
            $path .= '..' . DIRECTORY_SEPARATOR;
        }

        foreach (static::$requires as $file) {
            $requires[] = $path . $file . '.php';
        }

        return $requires;
    }

}
