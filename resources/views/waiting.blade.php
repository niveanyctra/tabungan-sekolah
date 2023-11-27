<x-student-layout>
    @push('styles')
        <style>
            .waiting-page {
                background-color: #fff;
                padding: 20px;
                width: 90%;
                max-width: 400px;
                text-align: center;
            }

            .waiting-page img {
                width: 100%;
                height: auto;
            }

            .waiting-page h1 {
                font-size: 20px;
                color: #333;
                margin-bottom: 15px;
            }

            .waiting-page p {
                font-size: 14px;
                color: #777;
                margin-bottom: 15px;
            }

            @media (min-width: 480px) {
                .waiting-page {
                    padding: 30px;
                }

                .waiting-page h1 {
                    font-size: 24px;
                }

                .waiting-page p {
                    font-size: 16px;
                }
            }
        </style>
    @endpush
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 d-flex align-items-center justify-content-center">
                <div class="waiting-page">
                    <img src="{{ asset('img/waiting.jpg') }}" alt="Waiting">
                    <h1>Menunggu Konfirmasi</h1>
                    <p>Admin kami sedang meninjau akun Anda. Ini mungkin memerlukan waktu beberapa saat, jadi harap
                        bersabar.</p>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
