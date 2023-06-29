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

        $output_class_name = get_class($output);

        return match ($output_class_name) {
            'SvgContainer' => $this->outputSVG($output),
            'PdfContainer' => $this->outputPDF($output),
            default => throw new \LogicException('Unexpected Container Class'),
        };
    }

    /**
     * @throws LogicException
     */
    private function generateOutput(string $language, string $type): SvgContainer|PdfContainer
    {
        switch ($language) {
            case 'php' :
                return PdfContainer::generatePDF($language);
            case 'java':
                if ($type === 'pdf') {
                    return PdfContainer::generatePDF($language);
                } else {
                    return SvgContainer::generateSVG($language);
                }
            default:
                throw new \LogicException('Unexpected Language');
        }
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
