<?php

namespace Tests\Feature;

use Tests\TestCase;

class LegalPagesTest extends TestCase
{
    public function test_privacy_and_terms_pages_render_with_footer_links(): void
    {
        $this->get(route('privacy'))
            ->assertOk()
            ->assertSee(__('public/legal.privacy.title'))
            ->assertSee(route('terms'));

        $this->get(route('terms'))
            ->assertOk()
            ->assertSee(__('public/legal.terms.title'))
            ->assertSee(route('privacy'));
    }
}
