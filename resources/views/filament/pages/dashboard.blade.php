<x-filament::page>
    {{-- 🟦 بانر ترحيبي --}}
    <div class="bg-gradient-to-r from-indigo-100 via-blue-50 to-indigo-100 p-6 rounded-2xl shadow mb-6 relative overflow-hidden">
        <div class="z-10 relative">
            <h2 class="text-3xl font-bold text-indigo-800 mb-2">مرحبًا بك في لوحة التحكم التعليمية 🎓</h2>
            <p class="text-gray-700">يمكنك هنا إدارة الكورسات، المتعلمين، والاختبارات بكل سهولة وفعالية.</p>
        </div>
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="teacher" class="absolute w-24 top-4 end-4 opacity-20 hidden md:block" />
    </div>

    {{-- 📊 كروت الإحصائيات --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl shadow text-center">
            <div class="text-4xl font-bold text-indigo-700">{{ \App\Models\User::where('role','teacher')->count() }}</div>
            <div class="mt-2 text-gray-600 font-medium">عدد المعلمين</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <div class="text-4xl font-bold text-green-600">{{ \App\Models\User::where('role','student')->count() }}</div>
            <div class="mt-2 text-gray-600 font-medium">عدد الطلاب</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <div class="text-4xl font-bold text-purple-600">{{ \App\Models\Course::count() }}</div>
            <div class="mt-2 text-gray-600 font-medium">عدد الكورسات</div>
        </div>
    </div>

    {{-- ✨ اقتباس تحفيزي --}}
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded shadow">
        <p class="text-yellow-800 font-semibold text-lg">
            💡 "التعليم هو أقوى سلاح يمكنك استخدامه لتغيير العالم"
        </p>
        <p class="text-yellow-700 text-sm mt-1 text-end">- نيلسون مانديلا</p>
    </div>
</x-filament::page>
