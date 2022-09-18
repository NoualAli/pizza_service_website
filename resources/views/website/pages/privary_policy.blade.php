@extends('website.layouts.default')

@section('title', 'Privacy policy')

@section('content')
    {{-- <hero-component height="30vh" background="#00922E">
        <h1>Privacy policy</h1>
    </hero-component> --}}
    <hero-component height="30vh" src="{{ asset('assets/heros/privacy-policy.jpg') }}">
        <h1>Privacy policy</h1>
    </hero-component>
    <div class="container my-5">
        <p>Gharib Group Oy built the Pizza Service app as open-source/free app. This Privacy Policy for that Pizza Service
            (pizzaservice.fi) will collect the personal information like name, email, contacy number, etc when you use our
            mobile application.</p>
        <p>&nbsp;</p>
        <h3>Information Collection and Use</h3>
        <p>&nbsp;</p>
        <p>For a better experience, while using our Service, We may require you to provide us with certain personally
            identifiable information add whatever else you collect here(in pizzaservice.fi), e.g. users name, address,
            location,
            pictures The information that We request will be retained on your device and is not collected by us in any
            way/[retained by us and used as described in this privacy policy.</p>
        <p>&nbsp;</p>
        <p>The collected infromation is shared with third-party services because using the customer data we can provide
            personalize app behavour, our service &amp; product improvement.</p>
        <p>&nbsp;</p>
        <h3>Log Data</h3>
        <p>&nbsp;</p>
        <p>We want to inform you that whenever you use our Service, in a case of an error in the app We collect data and
            information (through third party products) on your phone called Log Data. This Log Data may include information
            such as your device Internet Protocol (&ldquo;IP&rdquo;) address, device name, operating system version, the
            configuration of the app when utilizing [my/our] Service, the time and date of your use of the Service, and
            other statistics.</p>
        <p>&nbsp;</p>
        <h3>Cookies</h3>
        <p>&nbsp;</p>
        <p>Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers. These are
            sent to your browser from the websites that you visit and are stored on your device's internal memory.</p>
        <p>&nbsp;</p>
        <p>This Service does not use these &ldquo;cookies&rdquo; explicitly. However, the app may use third party code and
            libraries that use &ldquo;cookies&rdquo; to collect information and improve their services. You have the option
            to either accept or refuse these cookies and know when a cookie is being sent to your device. If you choose to
            refuse our cookies, you may not be able to use some portions of this Service.</p>
        <p>&nbsp;</p>
        <h3>
            Service Providers
        </h3>
        <p>&nbsp;</p>
        <p>We may employ third-party companies and individuals due to the following reasons:</p>
        <p>&nbsp;</p>
        <ul>
            <li>
                To facilitate our Service;
            </li>
            <li>
                To provide the Service on our behalf;
            </li>
            <li>
                To perform Service-related services; or
            </li>
            <li>
                To assist us in analyzing how our Service is used.
            </li>
        </ul>
        <p>We want to inform users of this Service that these third parties have access to your Personal Information. The
            reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or
            use the information for any other purpose.</p>
        <p>&nbsp;</p>
        <h3>Security</h3>
        <p>&nbsp;</p>
        <p>We value your trust in providing us your Personal Information, thus we are striving to use commercially
            acceptable means of protecting it. But remember that no method of transmission over the internet, or method of
            electronic storage is 100% secure and reliable, and We cannot guarantee its absolute security.</p>
        <p>&nbsp;</p>
        <h3>Changes to This Privacy Policy</h3>
        <p>&nbsp;</p>
        <p>We may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for
            any changes. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
        <p>&nbsp;</p>
        <h3>Contact Us</h3>
        <p>&nbsp;</p>
        <ul>
            <li>
                <a href="mailto:contact@pizzaservice.fi">contact@pizzaservice.fi</a>
            </li>
            <li>
                <a href="tel:+358443309343">+358443309343</a>
            </li>
        </ul>

    </div>
@endsection

@once
    @push('scripts')
        <script src="{{ asset(mix('website/js/default.js')) }}"></script>
    @endpush
@endonce
