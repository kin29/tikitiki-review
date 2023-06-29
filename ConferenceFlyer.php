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
        switch ($output_class_name) {
            case 'SvgContainer':
                return $this->outputSVG($output);
            case 'PdfContainer':
                return $this->outputPDF($output);
            default:
                throw new \LogicException('Unexpected Container Class');
        }
    }

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

    public function outputSVG(SvgContainer $container): bool {
        $result = /* ファイル書き込み処理 */

        return $result;
    }

    public function outputPDF(PdfContainer $container): bool {
        $result = /* ファイル書き込み処理 */

        return $result;
    }

    // [中略...]
}

// generatePDF()でPDF形式のデータを生成する
class PdfContainer {}
// generateSVG()でSVG形式のデータを生成する
class SvgContainer {}

// index.php
$flyer = new ConferenceFlyer();
$flyer->output('php', 'pdf');
