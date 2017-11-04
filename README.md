# Flight - a TYPO3 extension
Fluid everywhere for TYPO3 page generation

## What does it do?
It minimizes the usage of TypoScript for templating / content element generation.

It introduces a FLUIDPAGE TypoScript page object (as an alternative to PAGE), so 
TypoScript PAGE code is reduced.

## Out of the box
- Define your page layout and it maps "backend_layout" to a proper Page Template
- Paths for Page Templates, mapped on your site extension
- Paths for Content Elements, mapped on your site extension
- Deal with `<head>` parts other than TypoScript


## Installation
Just install the extension, that's it, then create a site and use `FLUIDPAGE`
for creating your site.


## ToDos
- Finish record enricher concept (data processors in good, done recursively)
- Build menus
- Build content renderings
- Resolve 'EXT:...' in absRefPrefix code.
- Automatically define fallback paths for a site constants (dependant on EXT:bolt)
- Think if Fluid ViewHelpers should be added (`<f:nonCacheable>`)
- Deal with language/locale in ViewHelpers
- Add JSONPAGE and add FLUIDPAGE.format = json


<strong>It works best with EXT:bolt, having to skip sys_templates
as well.</strong>