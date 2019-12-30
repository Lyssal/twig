<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\Twig\Extension;

use Lyssal\Text\Html;
use Twig_Extension;
use Twig_SimpleFilter;

/**
 * The Twig filters for rendering.
 */
class RenderingExtension extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('raw_secure', array($this, 'rawSecure'), array('is_safe' => array('html', 'css')))
        );
    }


    /**
     * Like the raw filter but secured.
     *
     * @param string $html The HTML to secure
     * @return string HTML
     */
    public function rawSecure($html)
    {
        $htmlObject = new Html($html);
        $htmlObject->deleteTags(array('applet', 'embed', 'frameset', 'head', 'iframe', 'noembed', 'noframes', 'noscript', 'object', 'script', 'style'));

        return $htmlObject->getText();
    }
}
