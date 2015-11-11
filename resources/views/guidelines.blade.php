@extends('templates.default')

@section('title')
	User Guidelines
@stop

@section('content')
	<h3>User Guidelines and ToS</h3>
		<p>By using the ConnectU.xyz web site ("Service"), or any services of ConnectU ("ConnectU"), you are agreeing to be bound by the following terms and conditions ("Terms of Service"). IF YOU ARE ENTERING INTO THIS AGREEMENT ON BEHALF OF A COMPANY OR OTHER LEGAL ENTITY, YOU REPRESENT THAT YOU HAVE THE AUTHORITY TO BIND SUCH ENTITY, ITS AFFILIATES AND ALL USERS WHO ACCESS OUR SERVICES THROUGH YOUR ACCOUNT TO THESE TERMS AND CONDITIONS, IN WHICH CASE THE TERMS "YOU" OR "YOUR" SHALL REFER TO SUCH ENTITY, ITS AFFILIATES AND USERS ASSOCIATED WITH IT. IF YOU DO NOT HAVE SUCH AUTHORITY, OR IF YOU DO NOT AGREE WITH THESE TERMS AND CONDITIONS, YOU MUST NOT ACCEPT THIS AGREEMENT AND MAY NOT USE THE SERVICES.</p>
		<p>Violation of any of the terms below will result in the termination of your Account. While ConnectU prohibits such conduct and Content on the Service, you understand and agree that ConnectU cannot be responsible for the Content posted on the Service and you nonetheless may be exposed to such materials. You agree to use the Service at your own risk.</p>
		<hr>
		<h3>A: Account Terms</h3>
		<ol>
			<li>You must be 13 years of age or older.</li>
			<li>You must be a human. Accounts registered as "bots" or any other automated methods are not permitted.</li>
			<li>You must provide your name, a valid email address, and any other information requested in order to complete the setup process.</li>
			<li>Your account may only used by one person - a single login shared by multiple people is not permitted.</li>
			<li>An exception to the previous two rules is that you may create an account representing a valid company and/or startup.</li>
			<li>You are responsible for maintaining the security of your account and password. ConnectU cannot and will not be liable for any loss or damage from your failure to comply with this security obligation.</li>
			<li>You are responsible for all Content posted and activity that occurs under your account.</li>
			<li>One person or legal entity may not maintain more than one account. Unless granted permission otherwise.</li>
			<li>You may not use the Service for any illegal or unauthorized purpose. You must not, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright or trademark laws).</li>
			<li>Your username or account name may not be used as "cyberbullying" or in any other hurtful manner towards any person or entity.</li>
			<li>Inactivity over 1 (one) year will result in account deletion.</li>
		</ol>
		<hr>
		<h3>B: General Conditions and others</h3>
		<ol>
			<li>Your use of the Service is at your sole risk. The service is provided on an "as is" and "as available" basis.</li>
			<li>Support for ConnectU services is only available in English, via email.</li>
			<li>You understand that ConnectU uses third-party vendors and hosting partners to provide the necessary hardware, software, networking, storage, and related technology required to run the Service.</li>
			<li>You must not modify, adapt or hack the Service or modify another website so as to falsely imply that it is associated with the Service, ConnectU, or any other ConnectU service.</li>
			<li>You may use the ConnectU Pages static hosting service solely as permitted and intended to host your organization pages, personal pages, or project pages, and for no other purpose. You may not use ConnectU Pages in violation of ConnectU's trademark or other rights or in violation of applicable law. ConnectU reserves the right at all times to reclaim any ConnectU subdomain without liability to you.</li>
			<li>You agree not to reproduce, duplicate, copy, sell, resell or exploit any portion of the Service, use of the Service, or access to the Service without the express written permission by ConnectU.</li>
			<li>We may, but have no obligation to, remove Content and Accounts containing Content that we determine in our sole discretion are unlawful, offensive, threatening, libelous, defamatory, pornographic, obscene or otherwise objectionable or violates any party's intellectual property or these Terms of Service.</li>
			<li>Verbal, physical, written or other abuse (including threats of abuse or retribution) of any ConnectU member, or administrator will result in immediate account termination.</li>
			<li>You understand that the technical processing and transmission of the Service, including your Content, may be transferred unencrypted and involve (a) transmissions over various networks; and (b) changes to conform and adapt to technical requirements of connecting networks or devices.</li>
			<li>You must not upload, post, host, or transmit unsolicited email, SMSs, or "spam" messages.</li>
			<li>You must not transmit any worms or viruses or any code of a destructive nature.</li>
			<li>ConnectU does not warrant that (i) the service will meet your specific requirements, (ii) the service will be uninterrupted, timely, secure, or error-free, (iii) the results that may be obtained from the use of the service will be accurate or reliable, (iv) the quality of any products, services, information, or other material purchased or obtained by you through the service will meet your expectations, and (v) any errors in the Service will be corrected.</li>
			<li>You expressly understand and agree that ConnectU shall not be liable for any direct, indirect, incidental, special, consequential or exemplary damages, including but not limited to, damages for loss of profits, goodwill, use, data or other intangible losses (even if ConnectU has been advised of the possibility of such damages), resulting from: (i) the use or the inability to use the service; (ii) the cost of procurement of substitute goods and services resulting from any goods, data, information or services purchased or obtained or messages received or transactions entered into through or from the service; (iii) unauthorized access to or alteration of your transmissions or data; (iv) statements or conduct of any third-party on the service; (v) or any other matter relating to the service.</li>
			<li>The failure of ConnectU to exercise or enforce any right or provision of the Terms of Service shall not constitute a waiver of such right or provision. The Terms of Service constitutes the entire agreement between you and ConnectU and govern your use of the Service, superseding any prior agreements between you and ConnectU (including, but not limited to, any prior versions of the Terms of Service). You agree that these Terms of Service and Your use of the Service are governed under California law.</li>
			<li>Questions of the Terms of Service shall be emailed to: <a href="mailto:help@connectu.xyz">help@connectu.xyz</a>.</li>
		</ol>
		<hr>
		<h3>C: FAQ</h3>
		<ul>
			<li>Q: How do I upload a profile picture?</li>
			<li>A: Right now, we currently use <a href="https://en.gravatar.com/" target="_blank">Gravatar</a> for our profile picture service. Signup there with the email you used here and you should be all set!</li>
			<hr>
			<li>Q: How can I follow updates to the website?</li>
			<li>A: We have a user for that. <a href="{{ route('profile.index', ['username' => 'updates']) }}">Updates</a> is what we use to display our changelogs and whatever news we have!</li>
			<hr>
			<li>Q: I forgot my password and I can't sign in!</li>
			<li>A: If you have forgotten your password, email <a href="mailto:help@connectu.xyz">help@connectu.xyz</a> with your username, and what you think your password is. Make sure you email us with the email you used to signup, otherwise we cannot reset your password. We then we will give you a temporary password. We would not recommend sticking with this password, and you should change it immediately after you regain access to your account.</li>
			<hr>
			<li>Q: What information do you collect from your users?</li>
			<li>A: We allow our users to have an option to put in their first and last name in, but it is not an option that we collect your IP, and last activity time. If the future, we may add more to the information collected list, but so far this is all that we collect.</li>
			<hr>
			<li>Q: Is there any way I can see statistics of the site?</li>
			<li>A: Yes! Here: <a href="{{ route('metrics') }}" target="_blank">Metrics</a> you can see what is going on!</li>
		</ul>

		<em>Last Updated: 10/28/2015 at 5:51 P.M. CST</em>
@stop