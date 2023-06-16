<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* base.twig */
class __TwigTemplate_83e9b0ebfda43c9ef2fc1483d08a95cc extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0\" />
    <link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->getBasePath(), "html", null, true);
        echo "/styles/style.css\">
    <title>MiniPress</title>
    ";
        // line 11
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 14
        echo "</head>
<body>
<header>
    <nav id=\"nav-app\">
        <ul>
            <li><a href=\"\">MiniPress</a></li>
            <li><a href=\"\">Acceuil</a></li>
            <li><a href=\"\">Articles</a></li>
        </ul>
    </nav>
    <input type=\"text\" placeholder=\"Rechercher un article\">
    <nav id=\"nav-account\">
        <ul>
            <li><a href=\"\" id=\"panier\">Panier</a></li>
            <li><a href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("connexion"), "html", null, true);
        echo "\" id=\"connexion\" class=\"button\">Connexion</a></li>
        </ul>
    </nav>
</header>
<main>
";
        // line 33
        $this->displayBlock('main', $context, $blocks);
        // line 36
        echo "</main>
<footer>

</footer>
</body>
</html>";
    }

    // line 11
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 12
        echo "    
    ";
    }

    // line 33
    public function block_main($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 34
        echo "
";
    }

    public function getTemplateName()
    {
        return "base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 34,  100 => 33,  95 => 12,  91 => 11,  82 => 36,  80 => 33,  72 => 28,  56 => 14,  54 => 11,  49 => 9,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "base.twig", "/var/www/src/templates/base.twig");
    }
}
