<?php
declare(strict_types=1);

class ConferenceFlyer
{
    // [中略...]
    /**
     * @throws LogicException
     */
    public function output(string $language, string $type): bool
    {
        $output = $this->generateOutput($language, $type);

        return match ($output::class) {
            SvgContainer::class => $this->outputSVG($output),
            PdfContainer::class => $this->outputPDF($output),
            default => throw new \LogicException('Unexpected Container Class'),
        };
    }

    /**
     * @throws LogicException
     */
    private function generateOutput(string $language, string $type): SvgContainer|PdfContainer
    {
        return match ($type) {
            'svg' => SvgContainer::generateSVG($language),
            'pdf' => PdfContainer::generatePDF($language),
            default => throw new \LogicException('Unexpected Language'),
        };
    }

    private function outputSVG(SvgContainer $container): bool {
        $result = /* ファイル書き込み処理 */

        return $result;
    }

    private function outputPDF(PdfContainer $container): bool {
        $result = /* ファイル書き込み処理 */

        return $result;
    }

    // [中略...]
}

class PdfContainer {
    public static function generatePDF(string $language): PdfContainer {
        return new self();
    }
}
class SvgContainer {
    public static function generateSVG(string $language): SvgContainer {
        return new self();
    }
}

// index.php
$flyer = new ConferenceFlyer();
$flyer->output('php', 'pdf');
