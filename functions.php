<?php

/*** Child Theme Function  ***/
function weiboo_theme_enqueue_scripts() {
	wp_register_style( 'childstyle', get_template_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childstyle' );
}
add_action('wp_enqueue_scripts', 'weiboo_theme_enqueue_scripts', 11);



add_action('add_meta_boxes', 'custom_product_fields_metabox');
function custom_product_fields_metabox() {
    add_meta_box(
        'custom_repeater_fields',
        'Custom Time & Pricing',
        'custom_repeater_fields_callback',
        'product',
        'normal',
        'default'
    );
}

function custom_repeater_fields_callback($post) {
    $values = get_post_meta($post->ID, '_custom_repeater_fields', true);
    wp_nonce_field('custom_repeater_nonce', 'custom_repeater_nonce_field');

    echo '<div id="repeater_wrapper">';
    
    if (!empty($values) && is_array($values)) {
        foreach ($values as $index => $row) {
            echo '<div class="repeater_row">';
            echo '<input type="text" name="custom_repeater_fields['.$index.'][time]" value="'.esc_attr($row['time']).'" placeholder="Time" />';
            echo '<input type="text" name="custom_repeater_fields['.$index.'][amount]" value="'.esc_attr($row['amount']).'" placeholder="Amount" />';
            echo '<input type="text" name="custom_repeater_fields['.$index.'][tax]" value="'.esc_attr($row['tax']).'" placeholder="Tax Amount" />';
            echo '<button type="button" class="remove_row">Remove</button>';
            echo '</div>';
        }
    }

    echo '</div>';
    echo '<button type="button" id="add_row">Add Row</button>';

    ?>
    <style>
        .repeater_row { margin-bottom: 10px; }
        .repeater_row input { margin-right: 10px; }
        .remove_row { background: #dc3545; color: #fff; border: none; padding: 5px 10px; }
        #add_row { margin-top: 10px; background: #28a745; color: #fff; padding: 5px 10px; border: none; }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('repeater_wrapper');
            const addBtn = document.getElementById('add_row');

            addBtn.addEventListener('click', function () {
                const index = wrapper.querySelectorAll('.repeater_row').length;
                const div = document.createElement('div');
                div.className = 'repeater_row';
                div.innerHTML = `
                    <input type="text" name="custom_repeater_fields[${index}][time]" placeholder="Time" />
                    <input type="text" name="custom_repeater_fields[${index}][amount]" placeholder="Amount" />
                    <input type="text" name="custom_repeater_fields[${index}][tax]" placeholder="Tax Amount" />
                    <button type="button" class="remove_row">Remove</button>
                `;
                wrapper.appendChild(div);
            });

            wrapper.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove_row')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
    <?php
}

add_action('save_post', 'save_custom_product_fields');
function save_custom_product_fields($post_id) {
    if (!isset($_POST['custom_repeater_nonce_field']) || !wp_verify_nonce($_POST['custom_repeater_nonce_field'], 'custom_repeater_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['custom_repeater_fields']) && is_array($_POST['custom_repeater_fields'])) {
        $cleaned = array_values(array_filter($_POST['custom_repeater_fields'], function($row) {
            return !empty($row['time']) || !empty($row['amount']) || !empty($row['tax']);
        }));

        update_post_meta($post_id, '_custom_repeater_fields', $cleaned);
    } else {
        delete_post_meta($post_id, '_custom_repeater_fields');
    }
}

add_action('woocommerce_after_variations_form', 'display_custom_product_data', 10);

function display_custom_product_data() {
    global $post;
    $rows = get_post_meta($post->ID, '_custom_repeater_fields', true);
    if (!empty($rows)) {
        echo '<div class="custom-time-price" style="margin-top: 20px;">';
        echo '<div class="pricing">'; // wrapper for flexbox layout

        foreach ($rows as $row) {
            echo '<div class="pricing-item">';
            echo '<div class="duration">' . esc_html($row['time']) . '</div>';
            echo '<div class="price">' . esc_html($row['amount']) . '</div>';
            echo '<div class="tax">' . esc_html($row['tax']) . '</div>';
            echo '</div>';
        }

        echo '</div></div>';
    }
}

add_action('wp_head', 'insert_google_gtag', 999); // 999 ensures it's near the end of <head>

function insert_google_gtag() {
    ?>
    <!-- Google tag (gtag.js) -->
<!--     <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16953384296"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'AW-16953384296');
    </script> -->
    <?php
}


/**
 * Tazy Tech LLC - Custom Popup Modal
 * Hooked to wp_footer to ensure it loads at the bottom of the page.
 */
add_action('wp_footer', 'tazy_tech_custom_popup_modal');

function tazy_tech_custom_popup_modal() {
    ?>
    <div id="tazy-tech-overlay" class="tazy-tech-overlay" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="tazy-tech-title">
        <div class="tazy-tech-modal">
            <button id="tazy-tech-close" class="tazy-tech-close" aria-label="Close popup">&times;</button>
            
            <div class="tazy-tech-header">
                <span class="tazy-tech-icon">✨</span>
                <h2 id="tazy-tech-title">Tazy Tech LLC</h2>
            </div>
            
            <div class="tazy-tech-body">
                <p>Tazy Tech LLC provides advanced technology solutions including AI Solutions, AI-integrated Websites, Graphic Designing, and Digital Signature services.</p>
            </div>
            
            <div class="tazy-tech-footer">
                <a href="https://wa.me/+923357671380" target="_blank" rel="noopener noreferrer" class="tazy-tech-cta">
                    <svg class="whatsapp-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    Reach Us on WhatsApp
                </a>
            </div>
        </div>
    </div>

    <style>
        /* Overlay with backdrop blur for modern UI */
        .tazy-tech-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        /* Show classes triggered by JS */
        .tazy-tech-overlay.is-visible {
            opacity: 1;
            visibility: visible;
        }

        /* Glassmorphism Modal Card */
        .tazy-tech-modal {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            padding: 40px 32px;
            width: 90%;
            max-width: 420px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0,0,0,0.02);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            transform: scale(0.9) translateY(20px);
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .tazy-tech-overlay.is-visible .tazy-tech-modal {
            transform: scale(1) translateY(0);
        }

        /* Close Button */
        .tazy-tech-close {
            position: absolute;
            top: 16px;
            right: 20px;
            background: transparent;
            border: none;
            font-size: 28px;
            color: #94a3b8;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.2s ease;
            line-height: 1;
            padding: 0;
        }

        .tazy-tech-close:hover {
            color: #475569;
            transform: scale(1.1);
        }

        /* Header & Icon */
        .tazy-tech-icon {
            display: inline-block;
            font-size: 32px;
            margin-bottom: 12px;
            animation: tazyFloat 3s ease-in-out infinite;
        }

        .tazy-tech-header h2 {
            margin: 0 0 16px;
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.02em;
        }

        /* Body Typography */
        .tazy-tech-body p {
            margin: 0 0 28px;
            font-size: 1.05rem;
            line-height: 1.6;
            color: #475569;
        }

        /* CTA Button */
        .tazy-tech-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.05rem;
            box-shadow: 0 10px 20px -5px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: tazyPulse 2.5s infinite;
        }

        .tazy-tech-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px -5px rgba(37, 211, 102, 0.5);
            text-decoration: none;
        }

        /* Animations */
        @keyframes tazyFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes tazyPulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        /* Optional Dark Mode Fallback */
        @media (prefers-color-scheme: dark) {
            .tazy-tech-modal {
                background: rgba(30, 41, 59, 0.85);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .tazy-tech-body p { color: #cbd5e1; }
            .tazy-tech-close { color: #64748b; }
            .tazy-tech-close:hover { color: #e2e8f0; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const overlay = document.getElementById('tazy-tech-overlay');
            const closeBtn = document.getElementById('tazy-tech-close');

            if (!overlay || !closeBtn) return;

            // Check localStorage to ensure it only shows once
            const hasSeenPopup = localStorage.getItem('tazyTechPopupShown');

            if (!hasSeenPopup) {
                // Show popup 5 seconds after page load
                setTimeout(() => {
                    overlay.classList.add('is-visible');
                    overlay.setAttribute('aria-hidden', 'false');
                    // Lock scrolling on the body while modal is open
                    document.body.style.overflow = 'hidden'; 
                }, 5000);
            }

            // Function to close the modal
            const closePopup = () => {
                overlay.classList.remove('is-visible');
                overlay.setAttribute('aria-hidden', 'true');
                // Restore scrolling
                document.body.style.overflow = ''; 
                // Mark as seen in localStorage
                localStorage.setItem('tazyTechPopupShown', 'true');
            };

            // Event Listeners for closing
            closeBtn.addEventListener('click', closePopup);

            // Close when clicking outside the modal box
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    closePopup();
                }
            });

            // Accessibility: Close on Escape key press
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && overlay.classList.contains('is-visible')) {
                    closePopup();
                }
            });
        });
    </script>
    <?php
}
