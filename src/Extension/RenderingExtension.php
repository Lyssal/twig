<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\Twig\Extension;

use Lyssal\Text\Html;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * The Twig filters for rendering.
 */
class RenderingExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            new TwigFilter('raw_secure', [$this, 'rawSecure'], ['is_safe' => ['html', 'css']])
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
