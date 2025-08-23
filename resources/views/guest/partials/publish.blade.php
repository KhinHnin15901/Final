<section class="flex items-center justify-center px-4 sm:px-6 lg:px-8 font-[Arial,sans-serif] max-w-3xl w-full">
    <div class="max-w-4xl w-full bg-white rounded-xl p-8 space-y-6 border-t-4 border-[#027c7d] shadow-md shadow-[#d6dd42]">
        <div class="text-center max-w-xl mx-auto mb-5">
            <h2 class="text-lg font-semibold text-[#000120]">Payment Form</h2>
            <p class="mt-2 text-sm text-gray-600">Please scan this QR code and pay. Then attach the receipt and send.</p>
        </div>
        <div>
            @if (session('success'))
                <div class="mb-5 rounded border border-green-500 bg-green-500/20 text-[#000120] px-4 py-3 font-semibold shadow-sm text-sm">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('publish.update', $journal_review->id) }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="flex justify-center items-center">
                    <img src="{{ asset('assets/img/journal_kpay_qr.jpg') }}"
                        alt="Journal KPay QR"
                        class="w-80 h-80 object-contain hover:scale-105 transition-transform duration-300"
                        onerror="this.style.display='none'">
                </div>

                <!-- Receipt -->
                <div>
                    <label for="kpay_receipt" class="block text-sm font-semibold text-[#027c7d]">Receipt (JPG, PNG, JPEG)</label>
                    <input id="kpay_receipt" name="kpay_receipt" type="file" accept=".jpg,.png,.jpeg" required
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120]
                               focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm mt-1 @error('kpay_receipt') border-red-500 @enderror" />
                    @error('kpay_receipt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-right">
                    <button
                        type="submit"
                        class="bg-[#027c7d] hover:bg-[#025955] text-white font-semibold px-5 py-2 rounded-md shadow-md transition-transform transform hover:scale-105 text-sm"
                    >
                        Request Publish
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
