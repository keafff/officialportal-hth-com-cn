<?php

/**
 * Class LinkCard
 *
 * Renders a sanitized HTML link card snippet.
 */
class LinkCard
{
    /**
     * @var string The destination URL for the card link.
     */
    private string $url;

    /**
     * @var string The title or keyword label for the card.
     */
    private string $title;

    /**
     * @var string Optional description text.
     */
    private string $description;

    /**
     * @var string Optional CSS class for custom styling.
     */
    private string $cssClass;

    /**
     * LinkCard constructor.
     *
     * @param string $url         The target URL.
     * @param string $title       The card title or keyword.
     * @param string $description A short description (default empty).
     * @param string $cssClass    An optional CSS class name (default 'link-card').
     */
    public function __construct(
        string $url,
        string $title,
        string $description = '',
        string $cssClass = 'link-card'
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->cssClass = $cssClass;
    }

    /**
     * Renders the HTML for the link card.
     *
     * All dynamic content is escaped to prevent XSS.
     *
     * @return string The escaped HTML string.
     */
    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedClass = htmlspecialchars($this->cssClass, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="' . $escapedClass . '">' . "\n";
        $html .= '    <a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">' . "\n";
        $html .= '        <h3>' . $escapedTitle . '</h3>' . "\n";
        if ($escapedDescription !== '') {
            $html .= '        <p>' . $escapedDescription . '</p>' . "\n";
        }
        $html .= '    </a>' . "\n";
        $html .= '</div>' . "\n";

        return $html;
    }

    /**
     * Static factory: create and render a card in one call.
     *
     * @param string $url         The target URL.
     * @param string $title       The card title or keyword.
     * @param string $description A short description (default empty).
     * @param string $cssClass    An optional CSS class name (default 'link-card').
     *
     * @return string The rendered HTML.
     */
    public static function createAndRender(
        string $url,
        string $title,
        string $description = '',
        string $cssClass = 'link-card'
    ): string {
        $card = new self($url, $title, $description, $cssClass);
        return $card->render();
    }
}

// ----------------------------------------------------------------------------
// Example usage
// ----------------------------------------------------------------------------

$targetUrl = 'https://officialportal-hth.com.cn';
$keyword = '华体会';

// Example 1: using the instance method
$card = new LinkCard($targetUrl, $keyword, '点击访问官方平台');
echo $card->render();

echo "\n---\n";

// Example 2: using the static factory
echo LinkCard::createAndRender($targetUrl, $keyword, '华体会官方入口', 'card-primary');

?>