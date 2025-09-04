<?php
/**
 * Template Name: Contact/Impressum
 *
 * The template for displaying the contact and impressum page
 */

get_header();
?>

<div class="container">
    <div class="main-content">
        <!-- Page Title -->
        <div style="margin-bottom: 2rem;">
            <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">
                <?php _e('Impressum', 'schabracke'); ?>
            </h1>
        </div>

        <div style="max-width: 64rem; margin: 0 auto; display: flex; flex-direction: column; gap: 2rem;">

            <!-- Contact Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <?php _e('Kontaktinformationen', 'schabracke'); ?>
                    </h2>
                </div>
                <div class="card-content">
                    <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <div>
                                    <h3 style="font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;"><?php _e('Adresse', 'schabracke'); ?></h3>
                                    <p style="color: #4b5563;">
                                        KJFE Schabracke<br>
                                        BA Pankow<br>
                                        Pestalozzistr. 8a<br>
                                        13187 Berlin
                                    </p>
                                </div>

                                <div>
                                    <h3 style="font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;"><?php _e('Vertreten durch', 'schabracke'); ?></h3>
                                    <p style="color: #4b5563;">Robert Pomierski</p>
                                </div>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <div>
                                    <h3 style="font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;"><?php _e('Kontakt', 'schabracke'); ?></h3>
                                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="#3b82f6">
                                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                            </svg>
                                            <a href="tel:030-4855080" style="color: #3b82f6; text-decoration: none;">030-4855080</a>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="#3b82f6">
                                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.89 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                            </svg>
                                            <a href="mailto:post@schabracke.net" style="color: #3b82f6; text-decoration: none;">post@schabracke.net</a>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 style="font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;"><?php _e('Verantwortlich für den Inhalt', 'schabracke'); ?></h3>
                                    <p style="color: #6b7280; font-size: 0.875rem;">nach § 55 Abs. 2 RStV:</p>
                                    <p style="color: #4b5563;">
                                        Robert Pomierski<br>
                                        Pestalozzistr. 8a<br>
                                        13187 Berlin
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Legal Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><?php _e('Angaben gemäß § 5 TMG', 'schabracke'); ?></h2>
                </div>
                <div class="card-content">
                    <p style="color: #4b5563; margin-bottom: 1rem;">
                        KJFE Schabracke<br>
                        BA Pankow<br>
                        Pestalozzistr. 8a<br>
                        13187 Berlin
                    </p>
                </div>
            </div>

            <!-- Disclaimer -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><?php _e('Haftungsausschluss', 'schabracke'); ?></h2>
                </div>
                <div class="card-content" style="display: flex; flex-direction: column; gap: 1.5rem;">

                    <div>
                        <h3 style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;"><?php _e('Haftung für Inhalte', 'schabracke'); ?></h3>
                        <p style="color: #4b5563; line-height: 1.6;">
                            Die Inhalte unserer Seiten wurden mit größter Sorgfalt erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte können wir jedoch keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
                        </p>
                    </div>

                    <div>
                        <h3 style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;"><?php _e('Haftung für Links', 'schabracke'); ?></h3>
                        <p style="color: #4b5563; line-height: 1.6;">
                            Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.
                        </p>
                    </div>

                    <div>
                        <h3 style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;"><?php _e('Urheberrecht', 'schabracke'); ?></h3>
                        <p style="color: #4b5563; line-height: 1.6;">
                            Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.
                        </p>
                    </div>

                </div>
            </div>

            <!-- Credits -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><?php _e('Impressum erstellt durch', 'schabracke'); ?></h2>
                </div>
                <div class="card-content">
                    <p style="color: #4b5563;">
                        Website Impressum erstellt durch
                        <a href="https://www.impressum-generator.de" target="_blank" style="color: #3b82f6; text-decoration: none;">impressum-generator.de</a>
                        von der
                        <a href="https://www.kanzlei-hasselbach.de/" target="_blank" style="color: #3b82f6; text-decoration: none;">Kanzlei Hasselbach</a>
                    </p>
                </div>
            </div>
            

        </div>
    </div>
    
</div>

<?php
get_footer();
?>
