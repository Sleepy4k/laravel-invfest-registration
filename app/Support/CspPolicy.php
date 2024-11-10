<?php

namespace App\Support;

use Spatie\Csp\Value;
use Spatie\Csp\Keyword;
use Spatie\Csp\Directive;
use Illuminate\Http\Request;
use Spatie\Csp\Policies\Policy as BasePolicy;
use Symfony\Component\HttpFoundation\Response;

class CspPolicy extends BasePolicy
{
    /**
     * Set csp policy to be dynamic base on condition that applied
     *
     * @param \Illuminate\Http\Request $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     *
     * @return bool
     */
    public function shouldBeApplied(Request $request, Response $response): bool
    {
        if (config('app.debug') && ($response->isClientError() || $response->isServerError())) {
            return false;
        }

        return parent::shouldBeApplied($request, $response);
    }

    /**
     * Configure csp policies for general and other policy
     *
     * @return void
     */
    public function configure()
    {
        $this
            ->addGeneralDirectives()
            ->addDirectivesForBunnyFonts()
            ->addDirectivesForYouTube();
    }

    protected function addGeneralDirectives(): self
    {
        return $this
            ->addDirective(Directive::BASE, Keyword::SELF)
            ->addDirective(Directive::CONNECT, config('app.debug') ? '*' : Keyword::SELF)
            ->addDirective(Directive::DEFAULT, Keyword::SELF)
            ->addDirective(Directive::FORM_ACTION, Keyword::SELF)
            ->addDirective(Directive::IMG, [
                Keyword::UNSAFE_INLINE,
                '*',
                'data:',
            ])
            ->addDirective(Directive::MEDIA, Keyword::SELF)
            ->addDirective(Directive::OBJECT, Keyword::NONE)
            ->addDirective(Directive::SCRIPT, [
                Keyword::SELF,
                Keyword::UNSAFE_INLINE,
                Keyword::STRICT_DYNAMIC,
                'www.google.com',
            ])
            ->addDirective(Directive::STYLE, [
                Keyword::SELF,
                Keyword::UNSAFE_INLINE,
            ])
            ->addDirective(Directive::UPGRADE_INSECURE_REQUESTS, Value::NO_VALUE)
            ->addDirective(Directive::BLOCK_ALL_MIXED_CONTENT, Value::NO_VALUE)
            ->addNonceForDirective(Directive::SCRIPT);
    }

    protected function addDirectivesForBunnyFonts(): self
    {
        return $this
            ->addDirective(Directive::FONT, 'fonts.bunny.net')
            ->addDirective(Directive::SCRIPT, 'fonts.bunny.net')
            ->addDirective(Directive::STYLE, 'fonts.bunny.net');
    }

    protected function addDirectivesForYouTube(): self
    {
        return $this->addDirective(Directive::FRAME, '*.youtube.com');
    }
}