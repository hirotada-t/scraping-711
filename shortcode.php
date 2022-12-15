<?php
if (!defined('ABSPATH')) exit;

// 商品検索
function product_serch()
{
  ob_start();
?>
  <style type="text/css">
    .is-style-btn_normal input:hover {
      box-shadow: 0 4px 12px rgb(0 0 0 / 10%), 0 12px 24px -12px rgb(0 0 0 / 20%);
      opacity: 1;
    }

    .is-style-btn_normal input {
      border-radius: 80px;
      color: #fff;
      font-weight: 700;
      transition: box-shadow .25s;
      position: relative;
      display: inline-block;
      min-width: 40%;
      margin: 0;
      padding: 0.75em 1.5em;
      line-height: 1.5;
      letter-spacing: 1px;
      text-decoration: none;
      background: var(--color_main);
    }
  </style>
  <form action="" method="post">
    <h3 class="u-mb-10">脂質で検索する</h3>
    <select style="width: 100%;" name="fat" id="">
      <option value="" selected>select</option>
      <option value="under5" <?php echo ($_POST["fat"] == "under5") ? "selected" : ""; ?>>～5g</option>
      <option value="over5under10" <?php echo ($_POST["fat"] == "over5under10") ? "selected" : ""; ?>>5～10g</option>
      <option value="over10under15" <?php echo ($_POST["fat"] == "over10under15") ? "selected" : ""; ?>>10～15g</option>
      <option value="over15" <?php echo ($_POST["fat"] == "over15") ? "selected" : ""; ?>>15g～</option>
    </select>
    <h3 class="u-mb-10">アレルギー品目を除外する</h3>
    <div class="swell-block-columns" style="--swl-fb:25%;--swl-fb_tab:14.28%;--swl-fb_pc:14.28%;--swl-clmn-mrgn--x:0.5rem">
      <div class="swell-block-columns__inner">
        <div class="swell-block-column swl-has-mb--s">
          <label for="allergy-egg">卵</label>
          <input type="checkbox" name="egg" value="egg" id="allergy-egg" <?php echo ($_POST["egg"] == "egg") ? "checked" : ""; ?>>
        </div>
        <div class="swell-block-column swl-has-mb--s">
          <label for="allergy-milk">乳</label>
          <input type="checkbox" name="milk" value="milk" id="allergy-milk" <?php echo ($_POST["milk"] == "milk") ? "checked" : ""; ?>>
        </div>
        <div class="swell-block-column swl-has-mb--s">
          <label for="allergy-wheat">小麦</label>
          <input type="checkbox" name="wheat" value="wheat" id="allergy-wheat" <?php echo ($_POST["wheat"] == "wheat") ? "checked" : ""; ?>>
        </div>
        <div class="swell-block-column swl-has-mb--s">
          <label for="allergy-shrimp">えび</label>
          <input type="checkbox" name="shrimp" value="shrimp" id="allergy-shrimp" <?php echo ($_POST["shrimp"] == "shrimp") ? "checked" : ""; ?>>
        </div>
        <div class="swell-block-column swl-has-mb--s">
          <label for="allergy-crab">かに</label>
          <input type="checkbox" name="crab" value="crab" id="allergy-crab" <?php echo ($_POST["crab"] == "crab") ? "checked" : ""; ?>>
        </div>
        <div class="swell-block-column swl-has-mb--s">
          <label for="allergy-nut">落花生</label>
          <input type="checkbox" name="nut" value="nut" id="allergy-nut" <?php echo ($_POST["nut"] == "nut") ? "checked" : ""; ?>>
        </div>
        <div class="swell-block-column swl-has-mb--s">
          <label for="allergy-soba">そば</label>
          <input type="checkbox" name="soba" value="soba" id="allergy-soba" <?php echo ($_POST["soba"] == "soba") ? "checked" : ""; ?>>
        </div>
      </div>
    </div>
    <h3 class="u-mb-10">並び順を変える</h3>
    <select style="width: 100%;" class="u-mb-10" name="sequence" id="">
      <option value="">select</option>
      <option value="sequence-p" <?php echo ($_POST["sequence"] == "sequence-p") ? "selected" : ""; ?>>（P）たんぱく質の多い順</option>
      <option value="sequence-f" <?php echo ($_POST["sequence"] == "sequence-f") ? "selected" : ""; ?>>（F）脂質の少ない順</option>
      <option value="sequence-c-des" <?php echo ($_POST["sequence"] == "sequence-c-des") ? "selected" : ""; ?>>（C）炭水化物の多い順</option>
      <option value="sequence-c-asc" <?php echo ($_POST["sequence"] == "sequence-c-asc") ? "selected" : ""; ?>>（C）炭水化物の少ない順</option>
      <option value="sequence-df" <?php echo ($_POST["sequence"] == "sequence-df") ? "selected" : ""; ?>>食物繊維の多い順</option>
      <option value="sequence-n" <?php echo ($_POST["sequence"] == "sequence-n") ? "selected" : ""; ?>>食塩の少ない順</option>
      <option value="sequence-price-des" <?php echo ($_POST["sequence"] == "sequence-price-des") ? "selected" : ""; ?>>価格の高い順</option>
      <option value="sequence-price-asc" <?php echo ($_POST["sequence"] == "sequence-price-asc") ? "selected" : ""; ?>>価格の安い順</option>
    </select>
    <div class="swell-block-button is-style-btn_normal">
      <input type="submit" name="serch_btn" value="検索する" class="swell-block-button__link">
    </div>
  </form>
<?php
  return ob_get_clean();
}
add_shortcode("serch", "product_serch");

// 商品一覧
function my_shortcode()
{
  $conditions = " WHERE 1=1 ";
  if ($_POST["serch_btn"]) {
    // アレルギー品目で検索する
    if ($_POST["egg"] == "egg") {
      $conditions .= " and allergy NOT LIKE '%卵%'";
    }
    if ($_POST["milk"] == "milk") {
      $conditions .= " and allergy NOT LIKE '%乳%'";
    }
    if ($_POST["wheat"] == "wheat") {
      $conditions .= " and allergy NOT LIKE '%小麦%'";
    }
    if ($_POST["shrimp"] == "shrimp") {
      $conditions .= " and allergy NOT LIKE '%えび%'";
    }
    if ($_POST["crab"] == "crab") {
      $conditions .= " and allergy NOT LIKE '%かに%'";
    }
    if ($_POST["nut"] == "nut") {
      $conditions .= " and allergy NOT LIKE '%落花生%'";
    }
    if ($_POST["soba"] == "soba") {
      $conditions .= " and allergy NOT LIKE '%そば%'";
    }

    // 脂質で検索する
    if ($_POST["fat"]) {
      if ($_POST["fat"] == "under5") {
        $conditions .= " and f<=5";
      } elseif ($_POST["fat"] == "over5under10") {
        $conditions .= " and f>=5 and f<=10";
      } elseif ($_POST["fat"] == "over10under15") {
        $conditions .= " and f>=10 and f<=15";
      } elseif ($_POST["fat"] == "over15") {
        $conditions .= " and f>=15";
      }
    }

    // 並び替えする
    if ($_POST["sequence"]) {
      if ($_POST["sequence"] == "sequence-p") {
        $conditions .= " ORDER BY p desc";
      } elseif ($_POST["sequence"] == "sequence-f") {
        $conditions .= " ORDER BY f asc";
      } elseif ($_POST["sequence"] == "sequence-c-asc") {
        $conditions .= " ORDER BY c asc";
      } elseif ($_POST["sequence"] == "sequence-c-des") {
        $conditions .= " ORDER BY c desc";
      } elseif ($_POST["sequence"] == "sequence-df") {
        $conditions .= " ORDER BY df desc";
      } elseif ($_POST["sequence"] == "sequence-n") {
        $conditions .= " ORDER BY n asc";
      } elseif ($_POST["sequence"] == "sequence-price-asc") {
        $conditions .= " ORDER BY price asc";
      } elseif ($_POST["sequence"] == "sequence-price-des") {
        $conditions .= " ORDER BY price desc";
      }
    }
  }
  ob_start();
  $sql = "SELECT * FROM products" . $conditions;
  $data = executeQuery($sql);

?>
  <style type="text/css">
    .p-blogCard__inner {
      padding: 0px;
    }

    #photo-area.viewport {
      height: 240px;
      width: 320px;
    }

    #photo-area.viewport canvas,
    video {
      float: left;
      width: 320px;
      height: 240px;
    }

    #photo-area.viewport canvas.drawingBuffer,
    video.drawingBuffer {
      margin-left: -320px;
    }
  </style>

  <?php
  $i = $data->num_rows;
  if ($i == 0) {
    echo "<p>条件を満たす商品が見つかりませんでした。</p>";
  } else {
    echo "<p>" . $i . "件の商品がヒットしました。</p>";
  }
  ?>

  <div class="alignwide swell-block-columns is-style-default u-mb-ctrl u-mb-10" style="--swl-fb_tab:100%;--swl-clmn-mrgn--x:0.5rem;--swl-clmn-mrgn--y:0.5rem">
    <div class="swell-block-columns__inner">
      <?php
      while ($para = $data->fetch_assoc()) :
        $para["p"] = number_format($para["p"], 1);
        $para["f"] = number_format($para["f"], 1);
        $para["c"] = number_format($para["c"], 1);
        $para["df"] = number_format($para["df"], 1);
        $para["n"] = number_format($para["n"], 1);
      ?>
        <div class="swell-block-column swl-has-mb--s">
          <figure class="wp-block-embed">
            <div class="p-blogCard -external -noimg" data-type="type3" data-onclick="clickLink">
              <div class="p-blogCard__inner">
                <div class="p-blogCard__body">
                  <a class="p-blogCard__title" href="https://www.sej.co.jp<?php echo $para["url"]; ?>" target="_blank" rel="noopener noreferrer">
                    <div class="swell-block-columns" style="--swl-fb:50%;--swl-clmn-mrgn--x:0.5rem;--swl-clmn-mrgn--y:0.5rem">
                      <div class="swell-block-columns__inner">
                        <div class="swell-block-column swl-has-mb--s" style="--swl-fb:30%;--swl-fb_tab:30%;--swl-fb_pc:30%;--swl-clmn-pddng:0rem 0rem 0rem 0rem">
                          <figure class="wp-block-image size-thumbnail">
                            <img width="150" height="150" src="<?php echo $para["img_src"]; ?>" data-src="<?php echo $para["img_src"]; ?>" alt="" class="wp-image-656 lazyloaded">
                            <noscript>
                              <img width="150" height="150" src="<?php echo $para["img_src"]; ?>" alt="" class="wp-image-656">
                            </noscript>
                            <figcaption class="u-mt-0 u-mb-10" style="color: #39a0ff;">詳細はコチラ <i class="fas fa-external-link-alt"></i></figcaption>
                          </figure>
                        </div>
                        <div class="swell-block-column swl-has-mb--s" style="--swl-fb:70%;--swl-fb_tab:70%;--swl-fb_pc:70%;--swl-clmn-pddng:0.2rem 0rem 0.2rem 0rem">
                          <h3 class="has-text-align-left is-style-section_ttl u-mb-ctrl u-mb-10 has-small-font-size"><?php echo $para["name"]; ?></h3>
                          <div class="u-mb-0" style="display: flex;">
                            <div style="width: 5em;">成分(g)…</div>
                            <div>
                              P<?php echo $para["p"]; ?>：F<?php echo $para["f"]; ?>：C<?php echo $para["c"]; ?><br>
                              食物繊維 <?php echo $para["df"]; ?>：食塩 <?php echo $para["n"]; ?>
                            </div>
                          </div>
                          <div class="u-mb-0" style="display: flex;">
                            <div style="width: 5em;">価格 …… </div>
                            <div><?php echo $para["price"]; ?>円</div>
                          </div>
                          <div class="u-mb-0">【アレルギー物質】<?php echo $para["allergy"]; ?></div>
                        </div>
                      </div>
                    </div>
                </div>
                </a>
                <span class="p-blogCard__excerpt"></span>
              </div>
            </div>
          </figure>
        </div>
      <?php $i++;
      endwhile; ?>
    </div>
  </div>

<?php
  return ob_get_clean();
}
add_shortcode("original_shortcode", "my_shortcode");
