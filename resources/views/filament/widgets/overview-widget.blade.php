<x-filament::widget>
    <x-filament::card>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-xl shadow text-center">
                <div class="text-4xl font-bold text-indigo-600">{{ \App\Models\Course::count() }}</div>
                <div class="mt-2 text-gray-700">الكورسات</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                <div class="text-4xl font-bold text-green-600">{{ \App\Models\User::role('teacher')->count() }}</div>
                <div class="mt-2 text-gray-700">المعلمين</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                <div class="text-4xl font-bold text-blue-600">{{ \App\Models\User::role('student')->count() }}</div>
                <div class="mt-2 text-gray-700">الطلاب</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                <div class="text-4xl font-bold text-orange-500">{{ \App\Models\Enrollment::count() }}</div>
                <div class="mt-2 text-gray-700">الاشتراكات</div>
            </div>
        </div>

        <div class="mt-8 p-6 bg-yellow-50 rounded-xl text-center border border-yellow-200">
            <p class="text-lg font-semibold text-yellow-800">
                "التعليم هو السلاح الأقوى الذي يمكنك استخدامه لتغيير العالم"
            </p>
            <p class="text-sm text-yellow-700 mt-2">- نيلسون مانديلا</p>
        </div>
    </x-filament::card>
</x-filament::widget>
