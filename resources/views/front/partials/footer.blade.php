<!-- Copyright -->
<div class="copyright-text">
    @if(substr(Request::path(), 0, 2) == "ar")
        <p>© {{ date("Y") }} بهلول. كل الحقوق محفوظة.</p>
    @elseif(substr(Request::path(), 0, 2) == "en")
        <p>© {{ date("Y") }} Bahloul. All Right Reserved.</p>
    @else
        <p>© {{ date("Y") }} Bahloul. Alle Rechte vorbehalten.</p>
    @endif
</div>
