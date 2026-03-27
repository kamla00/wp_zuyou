<?php
/**
 * Template Name: お問合せテンプレート
 */

// 部署ごとの送信先メールアドレス
$dept_emails = [
    '健診事業' => get_option( 'admin_email' ),
    '急患診療' => get_option( 'admin_email' ),
    '訪問看護' => get_option( 'admin_email' ),
    '在宅医療' => get_option( 'admin_email' ),
];

$step   = 'input';
$errors = [];
$fields = [
    'department'   => '',
    'your-name'    => '',
    'company-name' => '',
    'your-email'   => '',
    'your-tel'     => '',
    'message'      => '',
];

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $posted_step = isset( $_POST['_step'] ) ? $_POST['_step'] : '';

    // 入力値の取得・サニタイズ
    $fields['department']   = sanitize_text_field( wp_unslash( $_POST['department']   ?? '' ) );
    $fields['your-name']    = sanitize_text_field( wp_unslash( $_POST['your-name']    ?? '' ) );
    $fields['company-name'] = sanitize_text_field( wp_unslash( $_POST['company-name'] ?? '' ) );
    $fields['your-email']   = sanitize_email(      wp_unslash( $_POST['your-email']   ?? '' ) );
    $fields['your-tel']     = sanitize_text_field( wp_unslash( $_POST['your-tel']     ?? '' ) );
    $fields['message']      = sanitize_textarea_field( wp_unslash( $_POST['message']  ?? '' ) );

    if ( $posted_step === 'confirm' ) {
        // Nonce 検証
        if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'contact_send' ) ) {
            $errors[] = '不正なリクエストです。もう一度最初からお試しください。';
            $step = 'input';
        } else {
            $dept_to   = $dept_emails[ $fields['department'] ] ?? get_option( 'admin_email' );
            $site_name = get_bloginfo( 'name' );
            $headers   = [
                'From: ' . $site_name . ' <' . get_option( 'admin_email' ) . '>',
                'Content-Type: text/plain; charset=UTF-8',
            ];

            // 管理側への通知メール
            $admin_subject = '[' . $site_name . '] お問合せ（' . $fields['department'] . '）';
            $admin_body    = "以下のお問合せが届きました。\r\n\r\n"
                . "■ お問合せ部署：" . $fields['department']   . "\r\n"
                . "■ お名前：　　　" . $fields['your-name']    . "\r\n"
                . "■ 企業名：　　　" . $fields['company-name'] . "\r\n"
                . "■ メールアドレス：" . $fields['your-email'] . "\r\n"
                . "■ 電話番号：　　" . $fields['your-tel']     . "\r\n"
                . "■ お問合せ内容：\r\n" . $fields['message']  . "\r\n";

            // ユーザーへの自動返信メール
            $user_subject = '【' . $site_name . '】お問合せを受け付けました';
            $user_body    = $fields['your-name'] . " 様\r\n\r\n"
                . "お問合せいただきありがとうございます。\r\n"
                . "以下の内容でお問合せを受け付けました。\r\n"
                . "担当者よりご連絡いたしますので、しばらくお待ちください。\r\n\r\n"
                . "─────────────────────────\r\n"
                . "■ お問合せ部署：" . $fields['department']   . "\r\n"
                . "■ お名前：　　　" . $fields['your-name']    . "\r\n"
                . "■ 企業名：　　　" . $fields['company-name'] . "\r\n"
                . "■ メールアドレス：" . $fields['your-email'] . "\r\n"
                . "■ 電話番号：　　" . $fields['your-tel']     . "\r\n"
                . "■ お問合せ内容：\r\n" . $fields['message']  . "\r\n"
                . "─────────────────────────\r\n\r\n"
                . "※このメールは自動送信です。返信はご遠慮ください。\r\n"
                . get_bloginfo( 'url' );

            wp_mail( $dept_to,              $admin_subject, $admin_body, $headers );
            wp_mail( $fields['your-email'], $user_subject,  $user_body,  $headers );

            $step = 'complete';
        }

    } elseif ( $posted_step === 'input' ) {
        // バリデーション
        if ( ! array_key_exists( $fields['department'], $dept_emails ) ) {
            $errors[] = 'お問合せ部署を選択してください。';
        }
        if ( $fields['your-name'] === '' ) {
            $errors[] = 'お名前を入力してください。';
        }
        if ( $fields['your-email'] === '' || ! is_email( $fields['your-email'] ) ) {
            $errors[] = '正しいメールアドレスを入力してください。';
        }
        if ( $fields['message'] === '' ) {
            $errors[] = 'お問合せ内容を入力してください。';
        }
        $step = empty( $errors ) ? 'confirm' : 'input';
    } elseif ( $posted_step === 'back' ) {
        // 修正するボタンが押された場合
        $step = 'input';
    }
}

add_action( 'wp_head', function () { ?>
<style>
.contact-form { max-width: 800px; margin: 60px auto; padding: 0 20px; }
.contact-form__row { margin-bottom: 30px; display: flex; flex-wrap: wrap; }
.contact-form__label { width: 100%; max-width: 240px; font-weight: 700; font-size: 1.6rem; color: var(--mh--color--primary-800); margin-bottom: 10px; display: flex; align-items: center; }
@media (min-width: 768px) { .contact-form__label { margin-bottom: 0; padding-top: 12px; } }
.contact-form__required { background: var(--mh--color--primary-100); color: var(--mh--color--primary-800); font-size: 1.1rem; padding: 2px 8px; border-radius: 4px; margin-left: 10px; font-weight: 400; }
.contact-form__optional { background: #999; color: #fff; font-size: 1.1rem; padding: 2px 8px; border-radius: 4px; margin-left: 10px; font-weight: 400; }
.contact-form__input-wrap { flex: 1; min-width: 300px; }
.contact-form__radio-group { display: flex; flex-wrap: wrap; gap: 15px 25px; padding-top: 10px; }
.contact-form__radio-label { display: flex; align-items: center; gap: 8px; font-size: 1.5rem; cursor: pointer; }
.contact-form__radio-label input[type="radio"] { width: 20px; height: 20px; cursor: pointer; }
.contact-form__input[type="text"], .contact-form__input[type="email"], .contact-form__input[type="tel"], .contact-form__textarea { width: 100%; padding: 12px 15px; border: 1px solid #ccc; border-radius: 6px; font-size: 1.6rem; font-family: inherit; box-sizing: border-box; }
.contact-form__textarea { height: 200px; resize: vertical; }
.contact-form__input:focus, .contact-form__textarea:focus { outline: none; border-color: var(--mh--color--primary-400); box-shadow: 0 0 0 3px rgba(0,145,201,0.1); }
.contact-form__submit { text-align: center; margin-top: 50px; }
.contact-form__btn { display: inline-block; background: var(--mh--color--primary-500) !important; color: #fff !important; font-size: 1.8rem; font-weight: 700; padding: 18px 80px; border-radius: 50px; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(60,105,156,0.2); }
.contact-form__btn:hover { background: var(--mh--color--primary-400) !important; color: #fff !important; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(60,105,156,0.25); }
.contact-form__btn--back { background: #fff !important; color: var(--mh--color--primary-500) !important; border: 2px solid var(--mh--color--primary-300) !important; box-shadow: none; margin-right: 20px; }
.contact-form__btn--back:hover { background: var(--mh--color--primary-100) !important; color: var(--mh--color--primary-800) !important; transform: translateY(-2px); box-shadow: none; }
.contact-intro { display: flex; align-items: center; justify-content: center; gap: 30px; margin-bottom: 50px; flex-wrap: wrap; }
.contact-balloon { position: relative; background: #fff; border: 2px solid var(--mh--color--primary-200); border-radius: 15px; padding: 20px 25px; max-width: 450px; box-shadow: 0 4px 12px rgba(60,105,156,0.08); }
.contact-balloon::after { content: ""; position: absolute; top: 50%; right: -10px; margin-top: -10px; border-style: solid; border-width: 10px 0 10px 10px; border-color: rgba(0,0,0,0) rgba(0,0,0,0) rgba(0,0,0,0) #fff; z-index: 2; }
.contact-balloon::before { content: ""; position: absolute; top: 50%; right: -12px; margin-top: -11px; border-style: solid; border-width: 11px 0 11px 11px; border-color: rgba(0,0,0,0) rgba(0,0,0,0) rgba(0,0,0,0) #c6e0ec; z-index: 1; }
.contact-balloon__text { font-size: 1.5rem; line-height: 1.6; color: var(--mh--color--primary-800); font-weight: 500; margin: 0; }
.contact-intro__img { max-width: 150px; width: 100%; height: auto; }
@media (max-width: 767px) {
  .page-hero {
    height: auto;
    min-height: 0;
  }

  .page-hero__inner {
    padding-top: calc(var(--mh--header--height) + 28px);
    padding-bottom: 28px;
  }

  .page-hero__label {
    margin-bottom: 6px;
  }

  .page-hero__title {
    font-size: 2.9rem;
    line-height: 1.2;
  }

  .page-hero__sub {
    font-size: 1.3rem;
    line-height: 1.75;
    padding-top: 12px;
  }

  section.section { padding-top: 20px !important; padding-left: 10px !important; padding-right: 10px !important; }
  .l-container { padding-left: 0 !important; padding-right: 0 !important; }
  .contact-form { padding: 0; margin-top: 0; }
  .contact-intro { flex-direction: row-reverse; gap: 14px; flex-wrap: nowrap; align-items: center; margin-bottom: 20px; }
  .contact-intro__img { max-width: 90px; flex-shrink: 0; }
  .contact-balloon { padding: 5px 10px; }
  .contact-balloon::after { top: 50%; right: auto; left: -10px; margin-top: -10px; margin-right: 0; border-width: 10px 10px 10px 0; border-color: rgba(0,0,0,0) #fff rgba(0,0,0,0) rgba(0,0,0,0); }
  .contact-balloon::before { top: 50%; right: auto; left: -13px; margin-top: -11px; margin-right: 0; border-width: 11px 12px 11px 0; border-color: rgba(0,0,0,0) var(--mh--color--primary-200) rgba(0,0,0,0) rgba(0,0,0,0); }
  .contact-balloon__text { font-size: 1.3rem; }
}
/* エラー */
.contact-errors { max-width: 800px; margin: 0 auto 30px; padding: 20px 25px; background: #fff0f0; border-left: 4px solid #e63946; border-radius: 6px; }
.contact-errors__item { font-size: 1.5rem; color: #c0392b; margin: 4px 0; }
/* 確認テーブル */
.confirm-table { max-width: 800px; margin: 0 auto 50px; width: 100%; border-collapse: collapse; }
.confirm-table th, .confirm-table td { padding: 16px 20px; border-bottom: 1px solid var(--mh--color--primary-100); font-size: 1.6rem; text-align: left; vertical-align: top; }
.confirm-table th { width: 220px; font-weight: 700; color: var(--mh--color--primary-800); white-space: nowrap; }
.confirm-table td { color: var(--mh--color--grayscale-800); white-space: pre-wrap; word-break: break-word; }
.confirm-table tr:first-child th, .confirm-table tr:first-child td { border-top: 1px solid var(--mh--color--primary-100); }
@media (max-width: 767px) {
  .confirm-table th { width: 120px; }
}
/* 完了ページ */
.contact-complete { max-width: 700px; margin: 0 auto; text-align: center; padding: 60px 20px; }
.contact-complete__icon { font-size: 5rem; margin-bottom: 20px; }
.contact-complete__title { font-size: 2.4rem; font-weight: 700; color: var(--mh--color--primary-800); margin-bottom: 20px; }
.contact-complete__text { font-size: 1.6rem; line-height: 1.9; color: #555; margin-bottom: 40px; }
</style>
<?php }, 20 );
add_action( 'wp_footer', 'wp_zuyou_print_particle_canvas', 20 );

$_t = get_template_directory_uri();
get_header(); ?>
<main>

  <section class="page-hero page-hero--particle">
    <canvas class="page-hero__canvas" id="js-hero-canvas"></canvas>
    <div class="page-hero__inner">
      <div class="container">
        <p class="page-hero__label">Contact</p>
        <div class="page-hero__container">
          <h1 class="page-hero__title">お問合せ</h1>
          <p class="page-hero__sub">逗葉地域医療センターの各事業に関するご質問・ご相談を承っております。<br>以下のフォームより必要事項をご入力の上,送信してください。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section" style="background-color: #fff; padding-top: 40px;">
    <div class="l-container">

      <?php if ( $step === 'input' ) : ?>

        <div class="contact-intro">
          <div class="contact-balloon">
            <p class="contact-balloon__text">担当者からの返信に若干お時間をいただく場合があります。お急ぎの場合は電話にてご確認ください。</p>
          </div>
          <img src="<?php echo esc_url( $_t ); ?>/images/fm4-no-bg.webp" alt="" class="contact-intro__img">
        </div>

        <?php if ( ! empty( $errors ) ) : ?>
          <div class="contact-errors">
            <?php foreach ( $errors as $err ) : ?>
              <p class="contact-errors__item">・<?php echo esc_html( $err ); ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="contact-form">
          <form method="post" action="<?php echo esc_url( get_permalink() ); ?>">
            <input type="hidden" name="_step" value="input">
            <div class="contact-form__row">
              <div class="contact-form__label">お問合せ部署<span class="contact-form__required">必須</span></div>
              <div class="contact-form__input-wrap">
                <div class="contact-form__radio-group">
                  <label class="contact-form__radio-label"><input type="radio" name="department" value="健診事業" <?php checked( $fields['department'], '健診事業' ); ?>> 健診事業</label>
                  <label class="contact-form__radio-label"><input type="radio" name="department" value="急患診療" <?php checked( $fields['department'], '急患診療' ); ?>> 急患診療</label>
                  <label class="contact-form__radio-label"><input type="radio" name="department" value="訪問看護" <?php checked( $fields['department'], '訪問看護' ); ?>> 訪問看護</label>
                  <label class="contact-form__radio-label"><input type="radio" name="department" value="在宅医療" <?php checked( $fields['department'], '在宅医療' ); ?>> 在宅医療</label>
                </div>
              </div>
            </div>
            <div class="contact-form__row">
              <div class="contact-form__label">お名前<span class="contact-form__required">必須</span></div>
              <div class="contact-form__input-wrap">
                <input type="text" name="your-name" class="contact-form__input" placeholder="例：逗葉 太郎" value="<?php echo esc_attr( $fields['your-name'] ); ?>" required>
              </div>
            </div>
            <div class="contact-form__row">
              <div class="contact-form__label">企業名<span class="contact-form__optional">任意</span></div>
              <div class="contact-form__input-wrap">
                <input type="text" name="company-name" class="contact-form__input" placeholder="例：株式会社 逗葉" value="<?php echo esc_attr( $fields['company-name'] ); ?>">
              </div>
            </div>
            <div class="contact-form__row">
              <div class="contact-form__label">メールアドレス<span class="contact-form__required">必須</span></div>
              <div class="contact-form__input-wrap">
                <input type="email" name="your-email" class="contact-form__input" placeholder="例：info@example.com" value="<?php echo esc_attr( $fields['your-email'] ); ?>" required>
              </div>
            </div>
            <div class="contact-form__row">
              <div class="contact-form__label">電話番号<span class="contact-form__optional">任意</span></div>
              <div class="contact-form__input-wrap">
                <input type="tel" name="your-tel" class="contact-form__input" placeholder="例：046-873-4511" value="<?php echo esc_attr( $fields['your-tel'] ); ?>">
              </div>
            </div>
            <div class="contact-form__row">
              <div class="contact-form__label">お問合せ内容<span class="contact-form__required">必須</span></div>
              <div class="contact-form__input-wrap">
                <textarea name="message" class="contact-form__textarea" placeholder="お問合せ内容をご記入ください" required><?php echo esc_textarea( $fields['message'] ); ?></textarea>
              </div>
            </div>
            <div class="contact-form__submit">
              <button type="submit" class="contact-form__btn">入力内容を確認する</button>
            </div>
          </form>
        </div>

      <?php elseif ( $step === 'confirm' ) : ?>

        <div class="contact-form">
          <table class="confirm-table">
            <tr><th>お問合せ部署</th><td><?php echo esc_html( $fields['department'] ); ?></td></tr>
            <tr><th>お名前</th><td><?php echo esc_html( $fields['your-name'] ); ?></td></tr>
            <?php if ( $fields['company-name'] !== '' ) : ?>
            <tr><th>企業名</th><td><?php echo esc_html( $fields['company-name'] ); ?></td></tr>
            <?php endif; ?>
            <tr><th>メールアドレス</th><td><?php echo esc_html( $fields['your-email'] ); ?></td></tr>
            <?php if ( $fields['your-tel'] !== '' ) : ?>
            <tr><th>電話番号</th><td><?php echo esc_html( $fields['your-tel'] ); ?></td></tr>
            <?php endif; ?>
            <tr><th>お問合せ内容</th><td><?php echo esc_html( $fields['message'] ); ?></td></tr>
          </table>

          <form method="post" action="<?php echo esc_url( get_permalink() ); ?>">
            <input type="hidden" name="_step" value="confirm">
            <?php wp_nonce_field( 'contact_send' ); ?>
            <input type="hidden" name="department"   value="<?php echo esc_attr( $fields['department'] ); ?>">
            <input type="hidden" name="your-name"    value="<?php echo esc_attr( $fields['your-name'] ); ?>">
            <input type="hidden" name="company-name" value="<?php echo esc_attr( $fields['company-name'] ); ?>">
            <input type="hidden" name="your-email"   value="<?php echo esc_attr( $fields['your-email'] ); ?>">
            <input type="hidden" name="your-tel"     value="<?php echo esc_attr( $fields['your-tel'] ); ?>">
            <input type="hidden" name="message"      value="<?php echo esc_attr( $fields['message'] ); ?>">
            <div class="contact-form__submit">
              <button type="submit" name="_step" value="back" class="contact-form__btn contact-form__btn--back">修正する</button>
              <button type="submit" class="contact-form__btn">この内容で送信する</button>
            </div>
          </form>
        </div>

      <?php elseif ( $step === 'complete' ) : ?>

        <div class="contact-complete">
          <div class="contact-complete__icon">✉</div>
          <h2 class="contact-complete__title">お問合せを受け付けました</h2>
          <p class="contact-complete__text">
            お問合せいただきありがとうございます。<br>
            ご入力いただいたメールアドレス宛に受付確認メールをお送りしました。<br>
            担当者よりご連絡いたしますので、しばらくお待ちください。
          </p>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="contact-form__btn">トップページへ戻る</a>
        </div>

      <?php endif; ?>

    </div>
  </section>

</main>
<?php get_footer(); ?>

