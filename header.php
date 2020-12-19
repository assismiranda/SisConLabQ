
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <link rel="stylesheet" type="text/css" href="css_parte1.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css_parte2.css">
        <link rel="stylesheet" type="text/css" href="css_parte3.css" media="all">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <script type="text/javascript" src="javascript.js"></script>
</script>
        
        <title>Home</title>
    </head>
<body dir="ltr" class="cover-layout-layout-vazio template-view portaltype-collective-cover-content site-ourobranco section-home userrole-anonymous">
    <div id="wrapper">

        <!-- HEADER -->

        <div id="header" role="banner">
            <div>
                <div id="portal-title" class="corto">Laboratório de Ciências da Natureza</div>
            </div>
<?php if (isset($_SESSION['user'])) { ?>
            <div id="sobre">
                <ul>
                    <li id="portalservicos-portal-antigo-ifmg-ouro-branco" class="portalservicos-item">
                        <a href="sair.php" title="Sair">Sair</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- content -->

        <div id="main" role="main">
            <div id="plone-content">

            <!-- Demo Plone Content -->

            <div id="portal-columns" class="row">
                <!-- Column 1 -->
                <div id="navigation">
                    <div id="portal-column-one" class="cell width-1:4 position-0">
                        <div class="portletWrapper" id="portletwrapper-706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73" data-portlethash="706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73">
                            <dl class="portlet portletNavigationTree">
                                <dt class="portletHeader">
                                    <span class="portletTopLeft"></span>
                                    Reagente
                                    <span class="portletTopRight"></span>
                                </dt>

                                <dd class="portletItem lastItem">
                                    <ul class="navTree navTreeLevel0">
                                        <li class="navTreeItem visualNoMarker section-cursos-tecnicos">
                                            <a href="reagente.php" title="Reagentes" class="state-published">
                                                <span>Reagentes</span>
                                            </a>    
                                        </li>
                                        <li class="navTreeItem visualNoMarker section-graduacao">
                                            <a href="gestaoRG.php" title="Equipamentos" class="state-published">
                                                <span>Gestão do Estoque</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="portletBottomLeft"></span>
                                    <span class="portletBottomRight"></span>
                                </dd>
                            </dl>
                        </div>
                        <div class="portletWrapper" id="portletwrapper-706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73" data-portlethash="706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73">
                            <dl class="portlet portletNavigationTree">
                                <dt class="portletHeader">
                                    <span class="portletTopLeft"></span>
                                    Equipamento
                                    <span class="portletTopRight"></span>
                                </dt>

                                <dd class="portletItem lastItem">
                                    <ul class="navTree navTreeLevel0">
                                        <li class="navTreeItem visualNoMarker section-graduacao">
                                            <a href="equipamento.php" title="Equipamentos" class="state-published">
                                                <span>Equipamentos</span>
                                            </a>
                                        </li>
                                        <li class="navTreeItem visualNoMarker section-graduacao">
                                            <a href="gestaoE.php" title="Materiais" class="state-published">
                                                <span>Gestão do Estoque</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="portletBottomLeft"></span>
                                    <span class="portletBottomRight"></span>
                                </dd>
                            </dl>
                        </div>
                        <div class="portletWrapper" id="portletwrapper-706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73" data-portlethash="706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73">
                            <dl class="portlet portletNavigationTree">
                                <dt class="portletHeader">
                                    <span class="portletTopLeft"></span>
                                    Material
                                    <span class="portletTopRight"></span>
                                </dt>

                                <dd class="portletItem lastItem">
                                    <ul class="navTree navTreeLevel0">
                                        <li class="navTreeItem visualNoMarker section-cursos-tecnicos">
                                            <a href="material.php" title="Reagentes" class="state-published">
                                                <span>Materiais</span>
                                            </a>    
                                        </li>
                                        <li class="navTreeItem visualNoMarker section-graduacao">
                                            <a href="gestaoM.php" title="Equipamentos" class="state-published">
                                                <span>Gestão do Estoque</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="portletBottomLeft"></span>
                                    <span class="portletBottomRight"></span>
                                </dd>
                            </dl>
                        </div>

                        <div class="portletWrapper" id="portletwrapper-706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73" data-portlethash="706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73">
                            <dl class="portlet portletNavigationTree">
                                <dt class="portletHeader">
                                    <span class="portletTopLeft"></span>
                                    Relatórios
                                    <span class="portletTopRight"></span>
                                </dt>

                                <dd class="portletItem lastItem">
                                    <ul class="navTree navTreeLevel0">
                                        <li class="navTreeItem visualNoMarker section-cursos-tecnicos">
                                            <a href="relatorio.php" title="Relatórios" class="state-published">
                                                <span>Relatórios</span>
                                            </a>    
                                        </li>
                                    </ul>
                                    <span class="portletBottomLeft"></span>
                                    <span class="portletBottomRight"></span>
                                </dd>
                            </dl>
                        </div>
                        <div class="portletWrapper" id="portletwrapper-706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73" data-portlethash="706c6f6e652e6c656674636f6c756d6e0a636f6e746578740a2f6f75726f6272616e636f0a6e6f73736f732d637572736f73">
                            <dl class="portlet portletNavigationTree">
                                <dt class="portletHeader">
                                    <span class="portletTopLeft"></span>
                                    Agenda
                                    <span class="portletTopRight"></span>
                                </dt>

                                <dd class="portletItem lastItem">
                                    <ul class="navTree navTreeLevel0">
                                        <li class="navTreeItem visualNoMarker section-cursos-tecnicos">
                                            <a href="agenda.php" title="Agendar" class="state-published">
                                                <span>Agendar</span>
                                            </a>    
                                        </li>
                                    </ul>
                                    <span class="portletBottomLeft"></span>
                                    <span class="portletBottomRight"></span>
                                </dd>
                            </dl>
                        </div>
                    </div>  
                </div>
<?php }?>
                </html>