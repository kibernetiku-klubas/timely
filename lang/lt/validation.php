<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute laukelis privalo būti priimtas.',
    'accepted_if' => ':attribute laukelis privalo būti priimtas, kai :other yra :value.',
    'active_url' => ':attribute laukelis privalo būti tinkamas URL.',
    'after' => ':attribute privalo būti data po :date.',
    'after_or_equal' => ':attribute laukelis privalo būti data po arba lygi :date.',
    'alpha' => ':attribute laukelį privalo sudaryti tik raidės.',
    'alpha_dash' => ':attribute laukelyje gali būti tik raidės, skaičiai, brūkšneliai ir pabraukimai.',
    'alpha_num' => ':attribute laukelyje gali būti tik raidės ir skaičiai.',
    'array' => ':attribute laukelis gali būti masyvas.',
    'ascii' => ':attribute laukelyje gali būti tik vieno baito raidiniai skaitmeniniai simboliai.',
    'before' => ':attribute laukelis privalo būti data prieš :date.',
    'before_or_equal' => ':attribute privalo būti data prieš arba lygi :date.',
    'between' => [
        'array' => ':attribute laukelis privalo turėti tarp :min ir :max elementų.',
        'file' => ':attribute laukelis privalo būti tarp :min ir :max kilobaitų.',
        'numeric' => ':attribute laukelis privalo būti tarp :min ir :max.',
        'string' => ':attribute laukelis privalo būti tarp :min ir :max simbolių.',
    ],
    'boolean' => ':attribute laukelis privalo būti teisingas arba klaidingas.',
    'can' => ':attribute laukelyje yra netinkama reikšmė.',
    'confirmed' => ':attribute laukelio patvirtinimas neatitinka.',
    'current_password' => 'Slaptažodis yra neteisingas.',
    'date' => ':attribute laukelis privalo būti tinkama data.',
    'date_equals' => ':attribute laukelis privalo būti data lygi :date.',
    'date_format' => ':attribute laukelis privalo atitikti :format formatą.',
    'decimal' => ':attribute laukelis privalo turėti :decimal skaičių po kablelio.',
    'declined' => ':attribute laukelis privalo būti atmestas.',
    'declined_if' => ':attribute laukelis privalo būti atmestas kai :other yra :value.',
    'different' => ':attribute laukelis ir :other privalo būti skirtingi.',
    'digits' => ':attribute laukelis privalo būti sudarytas iš :digits skaitmenų.',
    'digits_between' => ':attribute laukelis privalo būti tarp :min ir :max skaitmenų.',
    'dimensions' => ':attribute laukelis turi netinkamus vaizdo matmenis.',
    'distinct' => ':attribute laukelis turi pasikartojančią reikšmę.',
    'doesnt_end_with' => ':attribute laukelis negali pasibaigti šiomis reikšmėmis: :values.',
    'doesnt_start_with' => ':attribute laukelis negali prasidėti šiomis reikšmėmis: :values.',
    'email' => ':attribute laukelis privalo būti tinkamas el. paštas.',
    'ends_with' => ':attribute laukelis privalo pasibaigti viena iš šių reikšmių: :values.',
    'enum' => 'Pasirinktas :attribute yra netinkamas.',
    'exists' => 'Pasirinktas :attribute yra netinkamas.',
    'file' => ':attribute laukelis privalo būti failas.',
    'filled' => ':attribute laukelis privalo turėti reikšmę.',
    'gt' => [
        'array' => ':attribute laukelis privalo turėti daugiau nei :value reikšmių.',
        'file' => ':attribute laukelis privalo būti didesnis už :value kilobaitų.',
        'numeric' => ':attribute laukelis privalo būti didesnis už :value.',
        'string' => ':attribute laukelis privalo būti didesnis už :value simbolių.',
    ],
    'gte' => [
        'array' => ':attribute laukelis privalo turėti :value elementų ar daugiau.',
        'file' => ':attribute laukelis privalo būti didesnis už arba lygus :value kilobaitams.',
        'numeric' => ':attribute laukelis privalo būti didesnis už arba lygus :value.',
        'string' => ':attribute laukelis privalo būti didesnis už arba lygus :value simbolių kiekiui.',
    ],
    'image' => ':attribute laukelis privalo būti nuotrauka.',
    'in' => 'Pasirinktas :attribute yra netinkamas.',
    'in_array' => ':attribute laukelis privalo egzistuoti :other.',
    'integer' => ':attribute laukelis privalo būti sveikasis skaičius.',
    'ip' => ':attribute laukelis privalo būti tinkamas IP adresas.',
    'ipv4' => ':attribute laukelis privalo būti tinkamas IPv4 adresas.',
    'ipv6' => ':attribute laukelis privalo būti tinkamas IPv6 adresas.',
    'json' => ':attribute laukelis privalo būti tinkama JSON eilutė.',
    'lowercase' => ':attribute laukelis privalo būti sudarytas iš mažųjų raidžių.',
    'lt' => [
        'array' => ':attribute laukelis privalo turėti mažiau nei :value elementų.',
        'file' => ':attribute laukelis privalo būti mažesnis nei :value kilobaitų.',
        'numeric' => ':attribute laukelis privalo būti mažesnis už :value.',
        'string' => ':attribute laukelis privalo būti mažesnis už :value simbolių.',
    ],
    'lte' => [
        'array' => ':attribute laukelis privalo neturėti daugiau už :value elementų.',
        'file' => ':attribute laukelis privalo būti mažesnis už ar lygus :value kilobaitams.',
        'numeric' => ':attribute laukelis privalo būti mažesnis už ar lygus :value.',
        'string' => ':attribute laukelis privalo būti mažesnis už ar lygus :value simbolių kiekiui.',
    ],
    'mac_address' => ':attribute laukelis privalo būti tinkamas MAC adresas.',
    'max' => [
        'array' => ':attribute laukelis negali turėti daugiau nei :max elementų.',
        'file' => ':attribute laukelis negali būti didesnis už :max kilobaitų.',
        'numeric' => ':attribute laukelis negali būti didesnis už :max.',
        'string' => ':attribute laukelis negali būti didesnis už :max simbolių kiekį.',
    ],
    'max_digits' => ':attribute laukelis negali turėti daugiau nei :max skaitmenų.',
    'mimes' => ':attribute laukelis privalo būti failas, kurio rūšis: :values.',
    'mimetypes' => ':attribute laukelis privalo būti failas, kurio rūšis: :values.',
    'min' => [
        'array' => ':attribute laukelis privalo turėti bent :min elementų.',
        'file' => ':attribute laukelis privalo būti bent :min kilobaitų.',
        'numeric' => ':attribute laukelis privalo būti bent :min.',
        'string' => ':attribute laukelis privalo turėti bent :min simbolius.',
    ],
    'min_digits' => ':attribute laukelis privalo turėti bent :min skaitmenų.',
    'missing' => ':attribute laukelis privalo būti tuščias.',
    'missing_if' => ':attribute laukelis privalo būti tuščias kai :other yra :value.',
    'missing_unless' => ':attribute laukelis privalo būti tuščias nebent :other yra :value.',
    'missing_with' => ':attribute laukelis privalo būti tuščias kai egzistuoja :values.',
    'missing_with_all' => ':attribute laukelis privalo būti tuščias kai egzistuoja :values.',
    'multiple_of' => ':attribute laukelis privalo būti daugiklis iš :value.',
    'not_in' => 'Pasirinktas :attribute yra netinkamas.',
    'not_regex' => ':attribute laukelio formatas netinkamas.',
    'numeric' => ':attribute laukelis privalo būti skaičius.',
    'password' => [
        'letters' => ':attribute laukelyje privalo būti bent viena raidė.',
        'mixed' => ':attribute laukelyje privalo būti bent viena didžioji ir mažoji raidė.',
        'numbers' => ':attribute laukelyje privalo būti bent vienas skaičius.',
        'symbols' => ':attribute laukelyje privalo būti bent vienas simbolis.',
        'uncompromised' => 'Įvestas :attribute jau yra nutekintas. Prašome pasirinkti kitą :attribute.',
    ],
    'present' => ':attribute laukelis privalo būti.',
    'prohibited' => ':attribute laukelis yra draudžiamas.',
    'prohibited_if' => ':attribute laukelis yra draudžiamas kai :other yra :value.',
    'prohibited_unless' => ':attribute laukelis yra draudžiamas nebent :other yra tarp :values.',
    'prohibits' => ':attribute laukelis neleidžia kad jame būtų :other.',
    'regex' => ':attribute laukelio formatas netinkamas.',
    'required' => ':attribute laukelis yra privalomas.',
    'required_array_keys' => ':attribute laukelyje privalo būti įrašų iš: :values.',
    'required_if' => ':attribute laukelis yra privalomas kai :other yra :value.',
    'required_if_accepted' => ':attribute laukelis yra privalomas kai :other yra priimtas.',
    'required_unless' => ':attribute laukelys yra privalomas nebent :other yra tarp :values.',
    'required_with' => ':attribute laukelis yra privalomas kai yra :values.',
    'required_with_all' => ':attribute laukelis yra privalomas kai yra :values reikšmės.',
    'required_without' => ':attribute laukelis yra privalomas kai neegzistuoja :values.',
    'required_without_all' => ':attribute laukelis yra privalomas kai egzistuoja nei vienas iš :values.',
    'same' => ':attribute laukelis privalo sutapti su :other.',
    'size' => [
        'array' => ':attribute laukelyje privalo būti :size elementų.',
        'file' => ':attribute laukelis privalo būti :size kilobaitų.',
        'numeric' => ':attribute laukelis privalo būti :size.',
        'string' => ':attribute laukelis privalo būti :size simbolių.',
    ],
    'starts_with' => ':attribute laukelis privalo prasidėti vienu iš: :values.',
    'string' => ':attribute laukelis privalo būti tekstinis.',
    'timezone' => ':attribute laukelis privalo būti tinkama laiko zona.',
    'unique' => ':attribute jau yra užimtas.',
    'uploaded' => 'Neišėjo įkelti :attribute.',
    'uppercase' => ':attribute laukelis privalo būti sudarytas iš didžiųjų raidžių.',
    'url' => ':attribute laukelis privalo būti tinkamas URL.',
    'ulid' => ':attribute laukelis privalo būti tinkamas ULID.',
    'uuid' => ':attribute laukelis privalo būti tinkamas UUID.',
    'captcha_required' => 'Patvirtinimas yra privalomas.',
    'captcha_captcha' => 'Patvirtinimas nepavyko, pabandykite iš naujo.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'password' => 'Slaptažodio',
        'current_password' => 'Dabartinio slaptažodžio',
    ],

];
