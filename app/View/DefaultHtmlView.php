<?php
namespace DevelopersNL\View;

class DefaultHtmlView implements ViewInterface
{
    public function __construct(
        public string $template,
        protected array $params = []
    ) {
    }

    public function __toString(): string
    {
        ob_start();
        require realpath('templates/bootstrap.phtml');
        return ob_get_clean();
    }

    public function parseTemplate(string $template): string
    {
        // Yes, this pattern breaks the Dependency Inversion Principle. I accepted that.
        ob_start();
        require realpath($template);
        return ob_get_clean();
    }

    public function __get($name)
    {
        return $this->params[$name] ?? '';
    }
}
