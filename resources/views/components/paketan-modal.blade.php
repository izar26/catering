<style>
    .modal-content {
        background-color: #2a2a2a; /* Dark background for the modal content */
        color: #e0e0e0; /* Light text color for modal content */
        border: none; /* Remove default border */
        border-radius: 15px; /* Softer rounded corners */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); /* Deeper shadow for elegance */
    }

    .modal-header {
        border-bottom: 1px solid #444; /* Subtle dark border */
        padding: 20px;
        background-color: #2a2a2a; /* Match modal content background */
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .modal-title {
        color: #f0f0f0 !important; /* Very light color for the title */
        font-weight: 600; /* Slightly bolder title */
    }

    .btn-close {
        filter: invert(1); /* Invert the color of the close button icon for dark theme */
        opacity: 0.7;
    }
    .btn-close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 30px;
        text-align: center;
    }

    .modal-body h3 {
        color: #f0f0f0; /* Light color for the package name */
        font-size: 2.2em; /* Slightly larger font for prominence */
        margin-bottom: 15px;
        letter-spacing: 1px; /* Add some letter spacing for a refined look */
    }

    .modal-body p {
        color: #cccccc; /* Slightly subdued light color for price */
        font-size: 1.2em;
        margin-top: 15px;
        font-weight: 500;
    }

    .modal-body strong {
        color: #e0e0e0; /* Ensure strong tags are also light */
    }

    .img-modal {
        border-radius: 15px; /* More rounded corners for the image */
        /* border: 2px solid #555; Subtle border around the image */
        max-width: 250px; /* Slightly larger image */
        transition: transform 0.3s ease; /* Smooth hover effect */
    } 

    .img-modal:hover {
        transform: scale(1.03); /* Slightly enlarge on hover */
    }

    /* Custom list for description */
    .custom-list {
        list-style: none;
        padding-left: 0;
        text-align: center; /* Centered list items */
        margin-top: 20px;
        margin-bottom: 30px;
    }

    .custom-list li {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px; /* Slightly more space for elegance */
        margin-bottom: 8px; /* More space between list items */
        color: #b0b0b0; /* Softer light color for description items */
        font-size: 1.1em;
    }

    .custom-list li::before {
        content: "•";
        color: #777; /* Darker dot for contrast */
        font-weight: bold;
        font-size: 1.2em; /* Slightly larger dot */
    }

    /* WhatsApp Button styling */
    .btn-success {
        background-color: #25D366; /* Standard WhatsApp green */
        border-color: #25D366;
        color: #ffffff;
        font-size: 1.1em;
        padding: 12px 25px;
        border-radius: 30px; /* Pill-shaped button */
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4); /* Green shadow */
    }

    .btn-success:hover {
        background-color: #1DA851; /* Darker green on hover */
        border-color: #1DA851;
        transform: translateY(-2px); /* Slight lift on hover */
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.6); /* More intense shadow on hover */
    }

    .btn-success i {
        margin-right: 8px; /* Space between icon and text */
    }
</style>

<div class="modal fade" id="modalPaket{{ $paket->id }}" tabindex="-1" aria-labelledby="modalPaketLabel{{ $paket->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">List Paket {{ $paket->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <h3 class="">{{ $paket->nama }}</h3>
                <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama }}" class="img-modal mb-3" style="max-width: 250px;">

                <p><strong>Harga:</strong> Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>

                <ul class="custom-list mb-3 text-center">
                    @foreach(explode("\n", $paket->deskripsi) as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>

                <a href="https://wa.me/{{ $profil->no_wa }}?text=Halo, saya tertarik dengan paket {{ urlencode($paket->nama) }}"
                   class="btn btn-success" target="_blank">
                    <i class="bi bi-whatsapp me-1"></i> Chat WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>