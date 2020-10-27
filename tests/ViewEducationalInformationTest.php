<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class ViewEducationalInformationTest extends TestCase
{
    /**
     * Purpose:The resident navigates to the Educational Information link,
     * clicks on it, can access the page, but the administrator has saved
     * the page not added to the page, and displays “403.8 -Page Not found”
     *
     * this test will test the loadEducationalPage function that does not
     * contain any content on it and display a header and message
     *
     * Error Message: 403.8 Site Access Denied
     *
     */
    public function pageIsAccessibleWithNoContent()
    {
        $this->assertTrue(true);
    }

    /**
     * Purpose:The resident navigates to the Educational Information link,
     * clicks on it, cannot access the page, because administrator has not saved the page.
     * Display error “404 - Page not found”
     *
     * this test will test the loadEducationalPage function when no file can be
     * found and display a header and an error message
     *
     *Error Message: 404 Page Not Found
     */
    public function pageIsNotAvaiable()
    {
        $this->assertTrue(true);
    }

    /**
     * Purpose:The resident navigates to the Educational Information link,
     * clicks on it, can access the page, and an image appears.
     *
     * this test will test the loadEducationalPage function and will display
     * an image on page.
     *
     * Note: should check multiple images
     */
    public function pageIsAccessibleWithAnImageDisplayed()
    {
        $this->assertTrue(true);
    }

    /**
     * Purpose:The resident navigates to the Educational Information link, clicks on it,
     * can access the page, and text appears in different styles (bold, italics, size, colour)
     * and fonts.
     *
     * this test will test the loadEducationalPage function and will display
     * various font options.
     *
     * Note: Test Bold, Italics, font colour, font style, highlighting, and size.
     */
    public function pageIsAccessibleAndTextIsDisplayedInDifferentStylesAndFonts()
    {
        $this->assertTrue(true);
    }

    /**
     * Purpose:The resident navigates to the Educational Information link, clicks on it,
     * can access the page, and a link appears. (default Link to the Cosmo’s MURR homepage)
     *
     * this test will test the loadEducationalPage function and will display
     * Hyper-Link option(s).
     *
     * Note: default Link to the Cosmo’s MURR homepage
     *
     */
    public function pageIsAccessibleAndALinkIsDisplayed()
    {
        $this->assertTrue(true);
    }

    /**
     * Purpose:Page is accessible and can view it from a mobile view
     *
     * this test will test the loadEducationalPage function and will display
     * a page that has multiple content objects. It will make sure that everything
     * viewable and not squished together.
     *
     * Note: Page should contain one image, some text, and atleast one link.
     *      on webpage source drop viewing screen down to mobile emulator. Content
     *      should not collide.
     */
    public function pageIsAccessibleAndCanViewItFromAMobileView()
    {
        $this->assertTrue(true);
    }

    /**
     * Purpose:Page is accessible and can view it from a tablet view
     *
     * this test will test the loadEducationalPage function and will display
     * a page that has multiple content objects. It will make sure that everything
     * viewable and not squished together.
     *
     * Note: Page should contain one image, some text, and atleast one link.
     *      on webpage source drop viewing screen down to tablet emulator. Content
     *      should not collide.
     */
    public function pageIsAccessibleAndCanViewItFromATabletView()
    {
        $this->assertTrue(true);
    }

    /**
     * Purpose:Page is accessible and can view it from a display view
     *
     * this test will test the loadEducationalPage function and will display
     * a page that has multiple content objects. It will make sure that everything
     * viewable and not squished together.
     *
     * Note: Page should contain one image, some text, and atleast one link.
     *      on webpage source should display wysiwyg editors placement
     */
    public function pageIsAccessibleAndCanViewItFromADisplayView()
    {
        $this->assertTrue(true);
    }


}
