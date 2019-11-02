<?

class Icon
{
  const MULTIPLE_COLOR_ICONS = array(
    'endoskopy' => 9,
  );

  public function __construct($icon, $additional_class = '')
  {
    $spans = '';
    if (array_key_exists($icon, self::MULTIPLE_COLOR_ICONS)) {
      for ($i = 1; $i <= self::MULTIPLE_COLOR_ICONS[$icon]; $i++) {
        $spans .= '<span class="path' . $i . '"></span>';
      }
    }
    echo '<div class="' . $additional_class . ' icon-' . $icon . '">' . $spans . '</div>';
  }
}
