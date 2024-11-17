<?php

namespace App\Support;

use Spatie\Csp\Value;
use Spatie\Csp\Keyword;
use Spatie\Csp\Directive;
use Illuminate\Http\Request;
use Spatie\Csp\Policies\Policy as BasePolicy;
use Spatie\Csp\Scheme;
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
            ->addDirectivesForGoogleFonts()
            ->addDirectivesForYouTube()
            ->addDirectivesForJsDelivrCDN()
            ->addDirectivesForCloudflareCDN()
            ->addDirectivesForTailwindcssCDN();
    }

    protected function addGeneralDirectives(): self
    {
        return $this
            ->addDirective(Directive::BASE, Keyword::SELF)
            ->addDirective(Directive::CONNECT, Keyword::SELF)
            ->addDirective(Directive::DEFAULT, Keyword::SELF)
            ->addDirective(Directive::FORM_ACTION, Keyword::SELF)
            ->addDirective(Directive::IMG, [
                '*',
                Scheme::DATA,
            ])
            ->addDirective(Directive::MEDIA, Keyword::SELF)
            ->addDirective(Directive::OBJECT, Keyword::NONE)
            ->addDirective(Directive::SCRIPT, [
                Keyword::SELF,
                Keyword::UNSAFE_INLINE,
            ])
            ->addDirective(Directive::STYLE, [
                Keyword::SELF,
                Keyword::UNSAFE_INLINE,
            ])
            ->addDirective(Directive::FONT, Keyword::SELF)
            ->addDirective(Directive::FRAME, Keyword::SELF)
            ->addDirective(Directive::UPGRADE_INSECURE_REQUESTS, Value::NO_VALUE)
            ->addDirective(Directive::BLOCK_ALL_MIXED_CONTENT, Value::NO_VALUE);
    }

    protected function addDirectivesForBunnyFonts(): self
    {
        return $this
            ->addDirective(Directive::FONT, 'fonts.bunny.net')
            ->addDirective(Directive::SCRIPT, 'fonts.bunny.net')
            ->addDirective(Directive::STYLE, 'fonts.bunny.net');
    }

    protected function addDirectivesForGoogleFonts(): self
    {
        return $this
            ->addDirective(Directive::SCRIPT, 'fonts.googleapis.com')
            ->addDirective(Directive::FONT, [
                'fonts.googleapis.com',
                'fonts.gstatic.com',
            ])
            ->addDirective(Directive::STYLE, [
                'fonts.googleapis.com',
                'fonts.gstatic.com',
            ]);
    }

    protected function addDirectivesForYouTube(): self
    {
        return $this->addDirective(Directive::FRAME, '*.youtube.com');
    }

    protected function addDirectivesForJsDelivrCDN(): self
    {
        return $this
            ->addDirective(Directive::FONT, 'cdn.jsdelivr.net')
            ->addDirective(Directive::STYLE, 'cdn.jsdelivr.net')
            ->addDirective(Directive::SCRIPT, 'cdn.jsdelivr.net');
    }

    protected function addDirectivesForCloudflareCDN(): self
    {
        return $this
            ->addDirective(Directive::FONT, 'cdnjs.cloudflare.com')
            ->addDirective(Directive::STYLE, 'cdnjs.cloudflare.com')
            ->addDirective(Directive::SCRIPT, 'cdnjs.cloudflare.com');
    }

    protected function addDirectivesForTailwindcssCDN(): self
    {
        return $this
            ->addDirective(Directive::FONT, 'cdn.tailwindcss.com')
            ->addDirective(Directive::STYLE, 'cdn.tailwindcss.com')
            ->addDirective(Directive::SCRIPT, 'cdn.tailwindcss.com');
    }
}
