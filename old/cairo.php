<?php
// PNG output stuff
//$s = new CairoImageSurface(CairoFormat::ARGB32, 400, 400);
//$s->writeToPng("php://output");

header('Content-type: image/svg+xml');

$v = new CairoSvgSurface('php://output', 400, 400);

$c = new CairoContext($v);
$c->fill();

$c->setSourceRGB(1, 0, 0);
$c->setLineWidth(50);
$c->arc(200, 200, 100, 0, 2 * M_PI);
$c->stroke();

$c->setSourceRGB(0, 0, 0.6);
$c->rectangle(0, 160, 400, 75);
$c->fill();

$v->finish();

?>
