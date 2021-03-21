<?php
/**
 * Craft3 Static Files Autoversioning plugin for Craft CMS 3.x
 *
 * A Twig extension for CraftCMS (Craft3.x) that helps you cache-bust your assets
 *
 * @link      https://cooltronic.pl
 * @copyright Copyright (c) 2021 cooltronicpl
 */

namespace cooltronicpl\autoversioning\twigextensions;

use Craft;

/**
 * @author    cooltronicpl
 * @package   Craft3AssetsAutoversioning
 * @since     0.1
 */
class AutoversioningTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    private $_buildId = null;


    public function getName()
    {
        return 'Auto-Versioning';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('version', [$this, 'versioningFile']),
        ];
    }

    public function versioningFile($file)
    {
        if ($this->_buildId === null)
        {
            if (file_exists(Craft::getAlias('@root') .'/build.txt'))
            {
                $build = $this->_buildId = trim(file_get_contents(Craft::getAlias('@root').'/build.txt'));
            }
            else
            {
                $this->_buildId = false;
            }
        }

        if ($this->_buildId === false)
        {
            
            if (strpos($file, '/') !== 0 || !file_exists(Craft::getAlias('@webroot') .'/'.$file))
            {
                return $file;
            }     
            $build = filemtime(Craft::getAlias('@webroot') .'/'.$file);
        
        }
        else
        {
            $build = $this->_buildId;
        }

        return $file.'?v='.$build;
    }

}
