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

/* user/connexion.twig */
class __TwigTemplate_8bbe31693b88096cd1ba549acda20257 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.twig", "user/connexion.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_main($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 5
        echo "    <div class=\"sign sign-in\">
        <form id=\"sign\" action=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("connexion"), "html", null, true);
        echo "\" method=\"post\">
            <div class=\"title\">
                <h2>SE CONNECTER</h2>
            </div>
            <div class=\"input-box\">
                <div class=\"input-box-item\">
                    <input name=\"email\" type=\"text\" id=\"id\" placeholder=\"Email\" required>
                    <label for=\"id\"></label>
                    <span class=\"material-symbols-rounded icon\">email</span>
                </div>
                <div class=\"input-box-item\">
                    <input name=\"password\" type=\"password\" id=\"password\" placeholder=\"Mot de passe\" required>
                    <label for=\"password\"></label>
                    <span class=\"material-symbols-rounded icon\">lock</span>
                </div>
            </div>
            <button name=\"sign\" id=\"connexion\">Connexion</button>
            <div class=\"bottom\">
                <div class=\"remember\">
                    <label for=\"checkBox\">
                        Se souvenir de moi
                    </label>
                    <input type=\"checkbox\" name=\"remember\" id=\"checkBox\">
                </div>
                <div id=\"sign-up\">
                    <a href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("inscription"), "html", null, true);
        echo "\">S'inscrire</a>
                </div>
            </div>
        </form>
    </div>
";
    }

    public function getTemplateName()
    {
        return "user/connexion.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 31,  53 => 6,  50 => 5,  46 => 4,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "user/connexion.twig", "/var/www/src/templates/user/connexion.twig");
    }
}
