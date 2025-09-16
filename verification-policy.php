<?php  session_start();
include('includes/config.php');
include('includes/helper.php');
?>
<!doctype html>
<html lang="en-US" class="no-js">
  <head>

  <title>Privacy Policy | The Live Models </title>
  <meta name="description" content="Join The Live Models premium platform to chat, watch live streams, meet safely, and connect while you travel. Verified members worldwide in a trusted community.">
	<link rel="canonical" href="https://thelivemodels.com/" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="Privacy Policy | The Live Models">
<meta property="og:description" content="Chat, watch live streams, meet safely, and connect while you travel. Verified members worldwide in a trusted community.">
<meta property="og:url" content="https://thelivemodels.com/">
<meta property="og:image" content="https://thelivemodels.com/assets/images/og-image.jpg">
<meta property="og:site_name" content="The Live Models">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Privacy Policy | The Live Models">
<meta name="twitter:description" content="Join The Live Models to chat, watch live streams, meet safely, and connect while you travel. Verified members worldwide.">
<meta name="twitter:image" content="https://thelivemodels.com/assets/images/og-image.jpg">
<meta name="twitter:site" content="@thelivemodels">

<!-- Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "https://thelivemodels.com/#organization",
      "name": "The Live Models",
      "url": "https://thelivemodels.com/",
      "logo": "https://thelivemodels.com/assets/images/logo.png",
      "sameAs": [
        "https://x.com/thelivemodels",
        "https://www.instagram.com/the_livemodels",
        "https://www.tiktok.com/@thelivemodels"
      ],
      "description": "The Live Models is a verified global social networking and dating platform offering chat, live streaming, social meetups, and travel connections.",
      "foundingDate": "2025",
      "founder": {
        "@type": "Person",
        "name": "Kulwant Singh Jakhar"
      }
    },
    {
      "@type": "WebSite",
      "@id": "https://thelivemodels.com/#website",
      "url": "https://thelivemodels.com/",
      "name": "The Live Models",
      "description": "Chat, watch live streams, meet safely, and connect while you travel. Verified members worldwide in a trusted community.",
      "publisher": {
        "@id": "https://thelivemodels.com/#organization"
      },
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://thelivemodels.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
  ]
}
</script>

  
<?php include('includes/head.php'); ?>

</head>

<body id="app" class="advt-page min-h-screen bg-animated text-white socialwall-page">

	<!-- Premium Particle System -->
  <div class="particles" id="particles"></div>
    <!-- Ultra Premium Header -->
    <?php if (isset($_SESSION["log_user_id"])) { ?>
	<?php  include('includes/side-bar.php'); ?>
	<?php  include('includes/profile_header_index.php'); ?>
	<?php } else{ ?>
    <?php include('includes/header.php'); ?>
	<?php } ?>

    <div class="premium-wallet common-page-template">



        <div class="container mx-auto px-4 py-8 max-w-6xl relative z-10">
            <!-- Header -->
            <div class="text-center mb-8 wallet-header-h1">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                    The Live Models – Verification Policy 
                </h1>
                <p class="text-gray-300 text-lg">
				 <ul>
					<li><b>Effective Date:</b> 1 Aug 2025  </li>
					<li><b>Last Updated:</b> 20 August 2025 </li>
                 </ul>
			</div>
			
			
			<div class="glass-card p-6 common-pages">
			
			
			
			
			<ol>
<li>
<ol>
<li>
<ol>
<li><strong> Purpose &amp; Scope</strong></li>
</ol>
<p>This Verification Policy (&ldquo;Policy&rdquo;) explains how <strong>The Live Models (&ldquo;TLM&rdquo;)</strong>, a New Zealand&ndash;registered dating and social networking platform, verifies the identity of its <strong>Users</strong> and <strong>Creators</strong>. Verification helps protect community safety, reduce fraud, and ensure that all participants are adults.&nbsp;</p>
<p>This Policy applies to:&nbsp;</p>
<ul  style="list-style-type: disc;">
<li><strong>Users</strong> &ndash; all persons who create an account, browse, or use Wallet, Tokens, Messages, or Live Streams.&nbsp;</li>
<li><strong>Creators</strong> &ndash; Users who post or sell paid content, host Live Streams, or use the Meet &ndash; Request and Travel &ndash; Request features.&nbsp;</li>
</ul>
<br/><br/>
<ol start="2">
<li><strong> Definitions</strong></li>
</ol>
<ul  style="list-style-type: disc;">
<li data-aria-posinset="1"><strong>User</strong> &ndash; any registered account holder on TLM.&nbsp;</li>
<li data-aria-posinset="2"><strong>Creator</strong> &ndash; a User who uploads or sells paid content, Live Streams, or enables Meet &ndash; Request or Travel &ndash; Request.&nbsp;</li>
<li data-aria-posinset="3"><strong>Verification Vendor</strong> &ndash; a contracted third-party provider assisting TLM in identity checks.&nbsp;</li>
<li data-aria-posinset="4"><strong>Liveness Check</strong> &ndash; a real-time photo or video to confirm the person presenting the ID is alive and matches the document.&nbsp;</li>
<li data-aria-posinset="5"><strong>Step-Up Verification</strong> &ndash; additional checks (e.g., extra selfie, secondary ID, short video) triggered by risk signals.&nbsp;</li>
<li data-aria-posinset="6"><strong>Meet Feature</strong> &ndash; the optional tool allowing Users to request social meetings with Creators, where lawful.&nbsp;</li>
<li data-aria-posinset="7"><strong>Travel Feature</strong> &ndash; the optional tool allowing Users to request lawful travel-related activities with Creators, where permitted.&nbsp;</li>
</ul>
<br/><br/>
<ol start="3">
<li><strong> User Verification (Email)</strong></li>
</ol>
<ul  style="list-style-type: disc;">
<li  data-listid="3"  data-aria-posinset="1">All Users must verify their email by entering a one-time code (OTP).&nbsp;</li>
<li  data-listid="3"  data-aria-posinset="2">Accounts cannot be activated without a valid, unique email.&nbsp;</li>
<li  data-listid="3"  data-aria-posinset="3">Re-verification may be required if:&nbsp;</li>
<li data-leveltext="o" data-font="Courier New" data-listid="3"  data-aria-posinset="1" data-aria-level="2">Login occurs from a new device, IP, or location.&nbsp;</li>
<li data-leveltext="o" data-font="Courier New" data-listid="3"  data-aria-posinset="2" data-aria-level="2">Suspicious activity is detected (e.g., multiple failed logins).&nbsp;</li>
<li data-leveltext="o" data-font="Courier New" data-listid="3"  data-aria-posinset="3" data-aria-level="2">The account has been inactive for more than 12 months.&nbsp;</li>
<li  data-listid="3"  data-aria-posinset="4">Invalid, bounced, or abusive email addresses may result in suspension.&nbsp;</li>
</ul>
<br/><br/>
<ol start="4">
<li><strong> Creator Verification (Government ID)</strong></li>
</ol>
<p>Creators must undergo <strong>government ID verification</strong> before posting paid content, hosting Live Streams, or enabling Meet &ndash; Request / Travel &ndash; Request.&nbsp;</p>
<p><strong>Acceptable IDs:</strong>&nbsp;</p>
<ul  style="list-style-type: disc;">
<li  data-listid="4"  data-aria-posinset="1">Passport&nbsp;</li>
<li  data-listid="4"  data-aria-posinset="2">Driver Licence&nbsp;</li>
<li  data-listid="4"  data-aria-posinset="3">National ID Card&nbsp;</li>
</ul>
<p><strong>Requirements:</strong>&nbsp;</p>
<ul  style="list-style-type: disc;">
<li  data-listid="5"  data-aria-posinset="1">ID must be current (unexpired), legible, and issued by a recognised government.&nbsp;</li>
<li  data-listid="5"  data-aria-posinset="2">The Creator must provide a selfie with liveness detection.&nbsp;</li>
<li  data-listid="5"  data-aria-posinset="3">The name and date of birth must match the ID.&nbsp;</li>
<li  data-listid="5"  data-aria-posinset="4">Minimum age: <strong>18 years</strong>.&nbsp;</li>
<li  data-listid="5"  data-aria-posinset="5">Stage names may be displayed publicly, but must be linked to a verified legal identity.&nbsp;</li>
</ul>
<p><strong>Re-verification occurs when:</strong>&nbsp;</p>
<ul style="list-style-type: disc;">
<li  data-listid="6"  data-aria-posinset="1">ID expires.&nbsp;</li>
<li  data-listid="6"  data-aria-posinset="2">A name change is requested.&nbsp;</li>
<li  data-listid="6"  data-aria-posinset="3">Every 24 months.&nbsp;</li>
<li  data-listid="6"  data-aria-posinset="4">Risk flags arise (abuse reports, fraud signals, sanctions screening).&nbsp;</li>
</ul>
<br/><br/>
<ol start="5">
<li><strong> What Verification Confirms / What It Does Not</strong></li>
</ol>
<p><strong>Verification confirms:</strong>&nbsp;</p>
<ul style="list-style-type: disc;">
<li  data-listid="7"  data-aria-posinset="1">That the individual is at least 18 years old.&nbsp;</li>
<li  data-listid="7"  data-aria-posinset="2">That the account is linked to a real identity at the time of verification.&nbsp;</li>
</ul>
<p><strong>Verification does NOT confirm:</strong>&nbsp;</p>
<ul style="list-style-type: disc;">
<li  data-listid="8"  data-aria-posinset="1">Criminal history, background checks, or safety.&nbsp;</li>
<li  data-listid="8"  data-aria-posinset="2">Professional or personal qualifications.&nbsp;</li>
<li  data-listid="8"  data-aria-posinset="3">Health, employment, or legality of off-platform activities.&nbsp;</li>
</ul>
<br/><br/>
<ol start="6">
<li><strong> Badges &amp; Labels</strong></li>
</ol>
<p>Creators who pass ID checks receive a <strong>&ldquo;Verified Creator&rdquo;</strong> badge.&nbsp;</p>
<ul style="list-style-type: disc;">
<li  data-listid="9"  data-aria-posinset="1">The badge only indicates age and identity verification at a point in time.&nbsp;</li>
<li  data-listid="9"  data-aria-posinset="2">Misuse of the badge (e.g., implying TLM endorsement) is prohibited.&nbsp;</li>
<li  data-listid="9"  data-aria-posinset="3">Badges may be removed if verification expires, fails, or is revoked.&nbsp;</li>
</ul>
<br/><br/>
<ol start="7">
<li><strong> When We Deny, Limit, or Remove Access</strong></li>
</ol>
<p>TLM may deny or suspend access if:&nbsp;</p>
<ul style="list-style-type: disc;">
<li  data-listid="10"  data-aria-posinset="1">Verification fails (mismatched ID/selfie).&nbsp;</li>
<li  data-listid="10"  data-aria-posinset="2">Submitted documents are altered or fraudulent.&nbsp;</li>
<li  data-listid="10"  data-aria-posinset="3">The User is under 18.&nbsp;</li>
<li  data-listid="10"  data-aria-posinset="4">Duplicate or banned accounts are detected.&nbsp;</li>
<li  data-listid="10"  data-aria-posinset="5">The User appears on sanctions or watchlists.&nbsp;</li>
</ul>
<p>Consequences may include loss of Creator features, suspension, or permanent account termination.&nbsp;</p>
<br/><br/>
<ol start="8">
<li><strong> Step-Up &amp; Re-Verification Triggers</strong></li>
</ol>
<p>Additional checks may be required if:&nbsp;</p>
<ul style="list-style-type: disc;">
<li  data-listid="11"  data-aria-posinset="1">A Creator requests payouts or holds large Token balances.&nbsp;</li>
<li  data-listid="11"  data-aria-posinset="2">Multiple device or location logins are detected.&nbsp;</li>
<li  data-listid="11"  data-aria-posinset="3">A Creator receives repeated fraud or abuse reports.&nbsp;</li>
<li  data-listid="11"  data-aria-posinset="4">Requested by lawful authorities.&nbsp;</li>
</ul>
<br/><br/>
<ol start="9">
<li><strong> Geography &amp; Feature Gating</strong></li>
</ol>
<p>TLM may restrict or disable Meet &ndash; Request and Travel &ndash; Request features in certain jurisdictions.&nbsp;</p>
<ul style="list-style-type: disc;">
<li  data-listid="12"  data-aria-posinset="1">Users remain fully responsible for ensuring compliance with local laws when using these features.&nbsp;</li>
<li  data-listid="12"  data-aria-posinset="2">Extra attestations or confirmations may be required depending on geography.&nbsp;</li>
</ul>
<br/><br/>
<ol start="10">
<li><strong> Data Handling &amp; Privacy</strong></li>
</ol>
<ul style="list-style-type: disc;">
<li  data-listid="13"  data-aria-posinset="1">We collect only what is necessary for verification.&nbsp;</li>
<li  data-listid="13"  data-aria-posinset="2"><strong>Data collected:</strong> email address, government ID images, selfies/liveness videos, metadata.&nbsp;</li>
<li  data-listid="13"  data-aria-posinset="3"><strong>Retention:</strong>&nbsp;</li>
<li data-leveltext="o" data-font="Courier New" data-listid="13"  data-aria-posinset="1" data-aria-level="2">Creator ID records: minimum 5 years or as required by law.&nbsp;</li>
<li data-leveltext="o" data-font="Courier New" data-listid="13"  data-aria-posinset="2" data-aria-level="2">Email logs: 24 months.&nbsp;</li>
<li data-leveltext="o" data-font="Courier New" data-listid="13"  data-aria-posinset="3" data-aria-level="2">Liveness checks: 12 months.&nbsp;</li>
<li  data-listid="13"  data-aria-posinset="4">Data is encrypted in transit and at rest.&nbsp;</li>
<li  data-listid="13"  data-aria-posinset="5">Data is shared only with verification vendors under contract.&nbsp;</li>
<li  data-listid="13"  data-aria-posinset="6">Data is deleted on verified lawful request unless required for safety, dispute resolution, or legal obligations.&nbsp;</li>
</ul>
<p>See our [Privacy Policy] for details.&nbsp;<br />Contact: <a href="mailto:privacy@thelivemodels.com"><strong>privacy@thelivemodels.com</strong></a>&nbsp;</p>
<br/><br/>
<ol start="11">
<li><strong> Security Measures</strong></li>
</ol>
<p>We apply industry-standard protections, including:&nbsp;</p>
<ul  style="list-style-type: disc;">
<li  data-listid="14"  data-aria-posinset="1">Encryption of data in transit and at rest.&nbsp;</li>
<li  data-listid="14"  data-aria-posinset="2">Strict access controls and role-based permissions.&nbsp;</li>
<li  data-listid="14"  data-aria-posinset="3">Regular audits and logging of verification actions.&nbsp;</li>
</ul>
<br/><br/>
<ol start="12">
<li><strong> Appeals &amp; Error Correction</strong></li>
</ol>
<p>If verification fails, Users may appeal by:&nbsp;</p>
<ol>
<li data-leveltext="%1." data-font="" data-listid="15" data-list-defn-props="{&quot;335552541&quot;:0,&quot;335559685&quot;:720,&quot;335559991&quot;:360,&quot;469769242&quot;:[65533,0],&quot;469777803&quot;:&quot;left&quot;,&quot;469777804&quot;:&quot;%1.&quot;,&quot;469777815&quot;:&quot;multilevel&quot;}" data-aria-posinset="1">Submitting corrected or higher-quality documents.&nbsp;</li>
</ol>
<ol>
<li data-leveltext="%1." data-font="" data-listid="15" data-list-defn-props="{&quot;335552541&quot;:0,&quot;335559685&quot;:720,&quot;335559991&quot;:360,&quot;469769242&quot;:[65533,0],&quot;469777803&quot;:&quot;left&quot;,&quot;469777804&quot;:&quot;%1.&quot;,&quot;469777815&quot;:&quot;multilevel&quot;}" data-aria-posinset="2">Requesting manual review.&nbsp;</li>
</ol>
<p>We aim to resolve appeals within <strong>3&ndash;5 business days</strong>.&nbsp;</p>
<br/><br/>
<ol start="13">
<li><strong> Under-18 &amp; Exploitation Reporting</strong></li>
</ol>
<p>Any account found to be under 18 or involved in exploitation is immediately terminated.&nbsp;<br />TLM will cooperate with lawful authorities where required.&nbsp;</p>
<br/><br/>
<ol start="14">
<li><strong> Sanctions &amp; Prohibited Persons</strong></li>
</ol>
<p>We may deny or revoke verification for:&nbsp;</p>
<ul  style="list-style-type: disc;">
<li  data-listid="16"  data-aria-posinset="1">Persons in sanctioned or embargoed jurisdictions.&nbsp;</li>
<li  data-listid="16"  data-aria-posinset="2">Persons identified on sanctions/watchlists.&nbsp;</li>
</ul>
<br/><br/>
<ol start="15">
<li><strong> Changes to This Policy</strong></li>
</ol>
<p>We may update this Policy from time to time.&nbsp;</p>
<ul style="list-style-type: disc;">
<li  data-listid="17"  data-aria-posinset="1">Material changes will be notified at least 14 days before they take effect.&nbsp;</li>
<li  data-listid="17"  data-aria-posinset="2">Continued use of TLM after changes indicates acceptance.&nbsp;</li>
</ul>
<br/><br/>
<ol start="16">
<li><strong> Contact</strong></li>
</ol>
<ul style="list-style-type: disc;">
<li  data-listid="18"  data-aria-posinset="1"><strong>For data and verification queries:</strong> <a href="mailto:privacy@thelivemodels.com">privacy@thelivemodels.com</a>&nbsp;</li>
<li  data-listid="18"  data-aria-posinset="2"><strong>For legal notices:</strong> <a href="mailto:legal@thelivemodels.com">legal@thelivemodels.com</a>&nbsp;</li>
</ul>
</li>
</ol>
</li>
</ol>
			
			
			
			
			
			
			
			
			
			
			</div>
		
		
		</div>

    </div>

    <?php include('includes/footer.php'); ?>