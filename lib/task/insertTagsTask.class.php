<?php

class insertTagsTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'insertTags';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [fullData|INFO] task does things.
Call it with:

  [php symfony fullData|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $tagsArray = $this->getTagsArray();

    $this->insertTags($tagsArray, NULL);

  }

  private function insertTags($tagsArray, $parentId)
  {

    foreach ($tagsArray as $tagArray)
    {
      $sTag = new sTag();
      $sTag->setName($tagArray['title']);
      $sTag->setParentId($parentId);
      $sTag->save();

      if(isset($tagArray['children']))
      {
        $this->insertTags($tagArray['children'], $sTag->getId());
      }
    }
  }

  private function getTagsArray()
  {
    return array(
        array(
            'title' => 'Все для офиса',
            'children' => array(
                array(
                    'title' => 'Оборудование для презентаций',
                    'children' => array(
                        array(
                            'title' => 'Проекторы',
                            'children' => array(
                                array(
                                    'title' => 'Мультимедиа проекторы',
                                ),
                                array(
                                    'title' => 'Документ-камеры',
                                ),
                                array(
                                    'title' => 'Оверхед-проекторы',
                                ),
                                array(
                                    'title' => 'Слайд-проекторы',
                                )
                            )
                        ),
                        array(
                            'title' => 'Аксессуары для проекторов',
                        ),
                        array(
                            'title' => 'Экраны',
                        ),
                        array(
                            'title' => 'Доски',
                        ),
                        array(
                            'title' => 'Мобильные стенды',
                        )
                    )
                ),
                array(
                    'title' => 'Оргтехника',
                    'children' => array(
                        array(
                            'title' => 'Машинки для уничтожения бумаг',
                        ),
                        array(
                            'title' => 'Переплетные устройства',
                        ),
                        array(
                            'title' => 'Оборудование для АТС',
                        ),
                        array(
                            'title' => 'Ламинаторы',
                        ),
                        array(
                            'title' => 'Мини АТС',
                        ),
                        array(
                            'title' => 'Телефонные гарнитуры',
                        ),
                        array(
                            'title' => 'Факсы',
                        ),
                        array(
                            'title' => 'Расходные материалы',
                        ),
                        array(
                            'title' => 'Системные телефоны',
                        ),
                        array(
                            'title' => 'Калькуляторы',
                        ),
                        array(
                            'title' => 'Копиры и дупликаторы',
                        )
                    )
                ),
                array(
                    'title' => 'Канцелярские принадлежности',
                    'children' => array(
                        array(
                            'title' => 'Бумага',
                        ),
                        array(
                            'title' => 'Печати и штампы',
                        ),
                        array(
                            'title' => 'Ручки',
                        ),
                        array(
                            'title' => 'Ежедневники, записные книжки',
                        ),
                        array(
                            'title' => 'Краски, кисти, мелки',
                        ),
                        array(
                            'title' => 'Папки, файлы, конверты',
                        ),
                        array(
                            'title' => 'Дыроколы, степлеры',
                        ),
                        array(
                            'title' => 'Маркеры и фломастеры',
                        ),
                        array(
                            'title' => 'Органайзеры',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Карандаши',
                        ),
                        array(
                            'title' => 'Офисные наборы',
                        ),
                        array(
                            'title' => 'Скрепки, кнопки',
                        ),
                        array(
                            'title' => 'Тетради',
                        ),
                        array(
                            'title' => 'Инструменты для черчения',
                        ),
                        array(
                            'title' => 'Клей, скотч, штрих',
                        ),
                        array(
                            'title' => 'Блокноты',
                        ),
                        array(
                            'title' => 'Ластики, точилки',
                        ),
                        array(
                            'title' => 'Ножницы, ножи',
                        ),
                        array(
                            'title' => 'Линейки, угольники, транспортиры',
                        ),
                        array(
                            'title' => 'Бухгалтерские книги, бланки, формы',
                        )
                    )
                ),
                array(
                    'title' => 'Аксессуары',
                )
            )
        ),
        array(
            'title' => 'Животные и растения',
            'children' => array(
                array(
                    'title' => 'Корма и лакомства',
                ),
                array(
                    'title' => 'Сопутствующие товары',
                ),
                array(
                    'title' => 'Аквариумистика',
                    'children' => array(
                        array(
                            'title' => 'Освещение',
                        ),
                        array(
                            'title' => 'Аксессуары для кормления',
                        ),
                        array(
                            'title' => 'Аэрация, озонирование',
                        ),
                        array(
                            'title' => 'Фильтрация и стерилизация',
                        ),
                        array(
                            'title' => 'Аквариумы и тумбы',
                        ),
                        array(
                            'title' => 'Инвентарь для обслуживания аквариумов',
                        ),
                        array(
                            'title' => 'Аквариумная химия',
                        ),
                        array(
                            'title' => 'Терморегуляция',
                        ),
                        array(
                            'title' => 'Декорации для аквариума',
                        ),
                        array(
                            'title' => 'Аквариумные рыбки',
                        )
                    )
                ),
                array(
                    'title' => 'Растения',
                    'children' => array(
                        array(
                            'title' => 'Декоративно-цветущие растения',
                        ),
                        array(
                            'title' => 'Декоративно-лиственные растения',
                        ),
                        array(
                            'title' => 'Удобрения',
                        ),
                        array(
                            'title' => 'Кактусы',
                        )
                    )
                ),
                array(
                    'title' => 'Лекарственные препараты',
                ),
                array(
                    'title' => 'Витамины и добавки',
                ),
                array(
                    'title' => 'Одежда и обувь',
                )
            )
        ),
        array(
            'title' => 'Услуги',
            'children' => array(
                array(
                    'title' => 'Обучение, семинары и тренинги',
                    'children' => array(
                        array(
                            'title' => 'Сертификационные экзамены',
                        ),
                        array(
                            'title' => 'Курсы по менеджменту, маркетингу, рекламе',
                        ),
                        array(
                            'title' => 'Cisco Systems',
                        ),
                        array(
                            'title' => 'Защита информации',
                        ),
                        array(
                            'title' => 'Программирование',
                        ),
                        array(
                            'title' => 'Citrix',
                        ),
                        array(
                            'title' => 'Базы данных',
                        ),
                        array(
                            'title' => 'Администрирование',
                        )
                    )
                ),
                array(
                    'title' => 'Транспортные услуги',
                ),
                array(
                    'title' => 'Компьютерные услуги',
                    'children' => array(
                        array(
                            'title' => 'Регистрация доменных имен',
                        ),
                        array(
                            'title' => 'Хостинг',
                        )
                    )
                ),
                array(
                    'title' => 'Установка и обслуживание офисных АТС',
                ),
                array(
                    'title' => 'Юридические услуги',
                ),
                array(
                    'title' => 'Страхование',
                ),
                array(
                    'title' => 'Организация шоу и праздников',
                ),
                array(
                    'title' => 'Настройка и инсталляция оборудования',
                ),
                array(
                    'title' => 'Медицинские услуги',
                )
            )
        ),
        array(
            'title' => 'Путешествия, туризм',
            'children' => array(
                array(
                    'title' => 'Авиабилеты',
                ),
                array(
                    'title' => 'Железнодорожные билеты',
                ),
                array(
                    'title' => 'Туры',
                )
            )
        ),
        array(
            'title' => 'Телефоны',
            'children' => array(
                array(
                    'title' => 'Аксессуары для сотовых телефонов',
                    'children' => array(
                        array(
                            'title' => 'Зарядные устройства',
                        ),
                        array(
                            'title' => 'Аккумуляторы',
                        ),
                        array(
                            'title' => 'Чехлы',
                        ),
                        array(
                            'title' => 'Data-кабели',
                        ),
                        array(
                            'title' => 'Переходники',
                        ),
                        array(
                            'title' => 'Держатели',
                        ),
                        array(
                            'title' => 'Антенны',
                        ),
                        array(
                            'title' => 'Подвески',
                        )
                    )
                ),
                array(
                    'title' => 'Сотовые телефоны',
                ),
                array(
                    'title' => 'Запасные части для сотовых телефонов',
                    'children' => array(
                        array(
                            'title' => 'Корпуса и панели',
                        ),
                        array(
                            'title' => 'Дисплеи',
                        )
                    )
                ),
                array(
                    'title' => 'Радиотелефоны',
                ),
                array(
                    'title' => 'Проводные телефоны',
                ),
                array(
                    'title' => 'Bluetooth-гарнитуры',
                ),
                array(
                    'title' => 'Проводные гарнитуры',
                ),
                array(
                    'title' => 'Мобильный контент',
                ),
                array(
                    'title' => 'Блоки питания и аккумуляторы',
                ),
                array(
                    'title' => 'Тарифные планы',
                    'children' => array(
                        array(
                            'title' => 'Тарифные планы МТС',
                        ),
                        array(
                            'title' => 'Тарифные планы Би-Лайн',
                        ),
                        array(
                            'title' => 'Тарифные планы Мегафона',
                        )
                    )
                ),
                array(
                    'title' => 'Карты оплаты',
                    'children' => array(
                        array(
                            'title' => 'Телефонные карты',
                        ),
                        array(
                            'title' => 'Электронные деньги',
                        ),
                        array(
                            'title' => 'IP-телефония',
                        ),
                        array(
                            'title' => 'Интернет-карты',
                        )
                    )
                ),
                array(
                    'title' => 'Спутниковые телефоны',
                ),
                array(
                    'title' => 'Стационарные сотовые',
                )
            )
        ),
        array(
            'title' => 'Бытовая техника',
            'children' => array(
                array(
                    'title' => 'Для кухни',
                    'children' => array(
                        array(
                            'title' => 'Вытяжки',
                        ),
                        array(
                            'title' => 'Холодильники',
                            'children' => array(
                                array(
                                    'title' => 'Сумки-холодильники',
                                )
                            )
                        ),
                        array(
                            'title' => 'Встраиваемые рабочие поверхности',
                        ),
                        array(
                            'title' => 'Встраиваемые духовые шкафы',
                        ),
                        array(
                            'title' => 'Плиты',
                        ),
                        array(
                            'title' => 'Микроволновые печи',
                        ),
                        array(
                            'title' => 'Посудомоечные машины',
                        ),
                        array(
                            'title' => 'Электрочайники и термопоты',
                        ),
                        array(
                            'title' => 'Кофеварки',
                        ),
                        array(
                            'title' => 'Блендеры',
                        ),
                        array(
                            'title' => 'Соковыжималки',
                        ),
                        array(
                            'title' => 'Кухонные комбайны и измельчители',
                        ),
                        array(
                            'title' => 'Пароварки',
                        ),
                        array(
                            'title' => 'Мясорубки',
                        ),
                        array(
                            'title' => 'Тостеры',
                        ),
                        array(
                            'title' => 'Миксеры',
                        ),
                        array(
                            'title' => 'Хлебопечки',
                        ),
                        array(
                            'title' => 'Кофемолки',
                        ),
                        array(
                            'title' => 'Кухонные весы',
                        ),
                        array(
                            'title' => 'Другое оборудование',
                        ),
                        array(
                            'title' => 'Фритюрницы',
                        ),
                        array(
                            'title' => 'Аэрогрили',
                        ),
                        array(
                            'title' => 'Ломтерезки',
                        ),
                        array(
                            'title' => 'Мини-печи, ростеры',
                        ),
                        array(
                            'title' => 'Блинницы',
                        ),
                        array(
                            'title' => 'Сэндвичницы',
                        ),
                        array(
                            'title' => 'Фильтры для техники',
                        ),
                        array(
                            'title' => 'Электроварки',
                        ),
                        array(
                            'title' => 'Кулеры для воды и питьевые фонтанчики',
                        ),
                        array(
                            'title' => 'Измельчители пищевых отходов',
                        ),
                        array(
                            'title' => 'Сушилки для овощей, фруктов, грибов',
                        ),
                        array(
                            'title' => 'Электрические грили, барбекю, шашлычницы',
                        ),
                        array(
                            'title' => 'Комплекты встраиваемой техники',
                        ),
                        array(
                            'title' => 'Яйцеварки',
                        ),
                        array(
                            'title' => 'Домашние мини-пивоварни',
                        ),
                        array(
                            'title' => 'Йогуртницы',
                        )
                    )
                ),
                array(
                    'title' => 'Для дома',
                    'children' => array(
                        array(
                            'title' => 'Стиральные машины',
                        ),
                        array(
                            'title' => 'Пылесосы',
                        ),
                        array(
                            'title' => 'Швейное оборудование',
                            'children' => array(
                                array(
                                    'title' => 'Швейные машины',
                                ),
                                array(
                                    'title' => 'Аксессуары',
                                ),
                                array(
                                    'title' => 'Оверлоки',
                                ),
                                array(
                                    'title' => 'Вышивальные машины',
                                ),
                                array(
                                    'title' => 'Вязальные машины',
                                )
                            )
                        ),
                        array(
                            'title' => 'Утюги',
                        ),
                        array(
                            'title' => 'Фильтры и умягчители для воды',
                        ),
                        array(
                            'title' => 'Системы Умный дом',
                            'children' => array(
                                array(
                                    'title' => 'Управление освещением',
                                ),
                                array(
                                    'title' => 'Системы защиты от протечек воды',
                                ),
                                array(
                                    'title' => 'Управление климатом',
                                )
                            )
                        ),
                        array(
                            'title' => 'Аксессуары для пылесосов',
                        ),
                        array(
                            'title' => 'Гладильные системы',
                        ),
                        array(
                            'title' => 'Пароочистители',
                        ),
                        array(
                            'title' => 'Сушильные автоматы',
                        ),
                        array(
                            'title' => 'Картриджи и кассеты для фильтров',
                        ),
                        array(
                            'title' => 'Аксессуары для стиральных машин',
                        )
                    )
                ),
                array(
                    'title' => 'Климатическое оборудование',
                    'children' => array(
                        array(
                            'title' => 'Обогреватели, камины и тепловые завесы',
                        ),
                        array(
                            'title' => 'Кондиционеры',
                        ),
                        array(
                            'title' => 'Водонагреватели',
                        ),
                        array(
                            'title' => 'Очистители и увлажнители воздуха',
                        ),
                        array(
                            'title' => 'Вентиляторы',
                        ),
                        array(
                            'title' => 'Метеостанции',
                        ),
                        array(
                            'title' => 'Аксессуары для климатического оборудования',
                        ),
                        array(
                            'title' => 'Ионизаторы',
                        ),
                        array(
                            'title' => 'Комплектующие для кондиционеров',
                        ),
                        array(
                            'title' => 'Осушители воздуха',
                        )
                    )
                ),
                array(
                    'title' => 'Для индивидуального ухода',
                    'children' => array(
                        array(
                            'title' => 'Фены и приборы для укладки',
                        ),
                        array(
                            'title' => 'Напольные весы',
                        ),
                        array(
                            'title' => 'Электробритвы мужские',
                        ),
                        array(
                            'title' => 'Машинки для стрижки',
                        ),
                        array(
                            'title' => 'Эпиляторы и женские электробритвы',
                        ),
                        array(
                            'title' => 'Электрические зубные щетки',
                        ),
                        array(
                            'title' => 'Электробигуди',
                        )
                    )
                )
            )
        ),
        array(
            'title' => 'Досуг и развлечения',
            'children' => array(
                array(
                    'title' => 'Билеты',
                    'children' => array(
                        array(
                            'title' => 'Мюзикл',
                        ),
                        array(
                            'title' => 'Театр',
                        )
                    )
                )
            )
        ),
        array(
            'title' => 'Подарки, сувениры, цветы',
            'children' => array(
                array(
                    'title' => 'Наручные часы',
                ),
                array(
                    'title' => 'Сувениры',
                    'children' => array(
                        array(
                            'title' => 'Шкатулки для украшений',
                        ),
                        array(
                            'title' => 'Сувениры из камня',
                        ),
                        array(
                            'title' => 'Сувениры из металла',
                        ),
                        array(
                            'title' => 'Сувениры из стекла',
                        ),
                        array(
                            'title' => 'Сувениры из керамики',
                        ),
                        array(
                            'title' => 'Сувениры из фарфора',
                        ),
                        array(
                            'title' => 'Сувениры из дерева',
                        ),
                        array(
                            'title' => 'Музыкальные сувениры',
                        )
                    )
                ),
                array(
                    'title' => 'Картины',
                ),
                array(
                    'title' => 'Бизнес-сувениры',
                    'children' => array(
                        array(
                            'title' => 'Настольные наборы',
                        ),
                        array(
                            'title' => 'Глобусы',
                        )
                    )
                ),
                array(
                    'title' => 'Украшения и бижутерия',
                ),
                array(
                    'title' => 'Ручки и карандаши',
                ),
                array(
                    'title' => 'Новогодние товары',
                    'children' => array(
                        array(
                            'title' => 'Украшения',
                        ),
                        array(
                            'title' => 'Елки',
                        ),
                        array(
                            'title' => 'Деды Морозы',
                        )
                    )
                ),
                array(
                    'title' => 'Масштабные модели',
                ),
                array(
                    'title' => 'Аксессуары и принадлежности для моделирования',
                ),
                array(
                    'title' => 'Игры',
                ),
                array(
                    'title' => 'Ножи и аксессуары',
                ),
                array(
                    'title' => 'Фотоальбомы и рамки',
                ),
                array(
                    'title' => 'Подарочные наборы',
                ),
                array(
                    'title' => 'Декоративная посуда',
                ),
                array(
                    'title' => 'Цветы',
                    'children' => array(
                        array(
                            'title' => 'Подарочные и праздничные',
                        ),
                        array(
                            'title' => 'Траурная флористика',
                        )
                    )
                ),
                array(
                    'title' => 'Флаги и гербы',
                    'children' => array(
                        array(
                            'title' => 'Флаги',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Гербы',
                        )
                    )
                ),
                array(
                    'title' => 'Скульптуры и статуэтки',
                ),
                array(
                    'title' => 'Подарочные свечи',
                ),
                array(
                    'title' => 'Подарочная упаковка',
                ),
                array(
                    'title' => 'Открытки',
                ),
                array(
                    'title' => 'Карнавальные костюмы',
                ),
                array(
                    'title' => 'Иконы',
                ),
                array(
                    'title' => 'Оружие',
                ),
                array(
                    'title' => 'Подарочные сертификаты',
                ),
                array(
                    'title' => 'Постеры',
                ),
                array(
                    'title' => 'Нумизматика и филателия',
                ),
                array(
                    'title' => 'Ювелирные изделия',
                    'children' => array(
                        array(
                            'title' => 'Ювелирные украшения',
                        )
                    )
                ),
                array(
                    'title' => 'Фейерверки',
                ),
                array(
                    'title' => 'Кальяны',
                ),
                array(
                    'title' => 'Декоративные телефоны',
                ),
                array(
                    'title' => 'Награды и дипломы',
                ),
                array(
                    'title' => 'Воздушные шары',
                ),
                array(
                    'title' => 'Карманные часы',
                ),
                array(
                    'title' => 'Фляги',
                ),
                array(
                    'title' => 'Фотографии',
                )
            )
        ),
        array(
            'title' => 'Продукты, напитки, табак',
            'children' => array(
                array(
                    'title' => 'Чай, кофе, какао',
                    'children' => array(
                        array(
                            'title' => 'Кофе',
                        ),
                        array(
                            'title' => 'Чай',
                        ),
                        array(
                            'title' => 'Какао, шоколад',
                        )
                    )
                ),
                array(
                    'title' => 'Спортивное питание',
                ),
                array(
                    'title' => 'Кондитерские изделия',
                    'children' => array(
                        array(
                            'title' => 'Шоколад',
                        ),
                        array(
                            'title' => 'Букеты из конфет',
                        ),
                        array(
                            'title' => 'Конфеты',
                        ),
                        array(
                            'title' => 'Пряники, вафли, печенье',
                        ),
                        array(
                            'title' => 'Жевательная резинка',
                        ),
                        array(
                            'title' => 'Торты, пирожные',
                        ),
                        array(
                            'title' => 'Мед',
                        ),
                        array(
                            'title' => 'Мармелад, варенье',
                        ),
                        array(
                            'title' => 'Восточные сладости',
                        )
                    )
                ),
                array(
                    'title' => 'Детское питание',
                ),
                array(
                    'title' => 'Спиртные напитки',
                    'children' => array(
                        array(
                            'title' => 'Аксессуары',
                        )
                    )
                ),
                array(
                    'title' => 'Табачные изделия',
                    'children' => array(
                        array(
                            'title' => 'Аксессуары',
                            'children' => array(
                                array(
                                    'title' => 'Пепельницы',
                                ),
                                array(
                                    'title' => 'Портсигары',
                                ),
                                array(
                                    'title' => 'Хьюмидоры',
                                )
                            )
                        ),
                        array(
                            'title' => 'Табак',
                        ),
                        array(
                            'title' => 'Трубки',
                        ),
                        array(
                            'title' => 'Сигары',
                        ),
                        array(
                            'title' => 'Сигареты',
                        )
                    )
                ),
                array(
                    'title' => 'Консервированные продукты',
                    'children' => array(
                        array(
                            'title' => 'Мясные консервы',
                        ),
                        array(
                            'title' => 'Рыбные консервы',
                        ),
                        array(
                            'title' => 'Овощные консервы',
                        ),
                        array(
                            'title' => 'Консервированные фрукты',
                        )
                    )
                ),
                array(
                    'title' => 'Диетическое и лечебное питание',
                    'children' => array(
                        array(
                            'title' => 'Чай, кофе, напитки',
                        ),
                        array(
                            'title' => 'Зерновые хлебцы',
                        ),
                        array(
                            'title' => 'Бакалея',
                        ),
                        array(
                            'title' => 'Соусы, специи, приправы',
                        ),
                        array(
                            'title' => 'Заменители сахара',
                        )
                    )
                ),
                array(
                    'title' => 'Рыба',
                    'children' => array(
                        array(
                            'title' => 'Креветки, крабы, раки',
                        ),
                        array(
                            'title' => 'Морепродукты',
                        ),
                        array(
                            'title' => 'Рыба копченая',
                        ),
                        array(
                            'title' => 'Рыба соленая',
                        )
                    )
                ),
                array(
                    'title' => 'Бакалея',
                    'children' => array(
                        array(
                            'title' => 'Сахар',
                        ),
                        array(
                            'title' => 'Каши, супы, бульоны',
                        ),
                        array(
                            'title' => 'Масло растительное',
                        ),
                        array(
                            'title' => 'Соль, сода',
                        ),
                        array(
                            'title' => 'Мука, тесто',
                        ),
                        array(
                            'title' => 'Чипсы, сухарики',
                        )
                    )
                ),
                array(
                    'title' => 'Безалкогольные напитки',
                    'children' => array(
                        array(
                            'title' => 'Нектары',
                        ),
                        array(
                            'title' => 'Газированная вода',
                        ),
                        array(
                            'title' => 'Столовая вода',
                        ),
                        array(
                            'title' => 'Соки',
                        ),
                        array(
                            'title' => 'Минеральная вода',
                        )
                    )
                ),
                array(
                    'title' => 'Пиво и сухой солод',
                    'children' => array(
                        array(
                            'title' => 'Сухой солод',
                        ),
                        array(
                            'title' => 'Пиво',
                        )
                    )
                ),
                array(
                    'title' => 'Фрукты и овощи',
                    'children' => array(
                        array(
                            'title' => 'Фрукты',
                        ),
                        array(
                            'title' => 'Зелень',
                        )
                    )
                ),
                array(
                    'title' => 'Молочные продукты',
                    'children' => array(
                        array(
                            'title' => 'Масло, маргарин',
                        ),
                        array(
                            'title' => 'Молоко, сливки',
                        )
                    )
                ),
                array(
                    'title' => 'Еда быстрого приготовления',
                    'children' => array(
                        array(
                            'title' => 'Японская еда',
                        )
                    )
                ),
                array(
                    'title' => 'Соусы, специи',
                    'children' => array(
                        array(
                            'title' => 'Горчица',
                        ),
                        array(
                            'title' => 'Специи',
                        )
                    )
                ),
                array(
                    'title' => 'Мясо-птица',
                    'children' => array(
                        array(
                            'title' => 'Куры',
                        ),
                        array(
                            'title' => 'Мясные полуфабрикаты',
                        ),
                        array(
                            'title' => 'Пельмени',
                        )
                    )
                ),
                array(
                    'title' => 'Хлебобулочные изделия',
                    'children' => array(
                        array(
                            'title' => 'Булочки',
                        )
                    )
                )
            )
        ),
        array(
            'title' => 'Спортивные товары',
            'children' => array(
                array(
                    'title' => 'Туризм',
                    'children' => array(
                        array(
                            'title' => 'Палатки',
                        ),
                        array(
                            'title' => 'Спальные мешки',
                        ),
                        array(
                            'title' => 'Рюкзаки',
                        ),
                        array(
                            'title' => 'Фонари',
                        ),
                        array(
                            'title' => 'Посуда',
                        ),
                        array(
                            'title' => 'Компасы',
                        )
                    )
                ),
                array(
                    'title' => 'Тренажеры',
                    'children' => array(
                        array(
                            'title' => 'Силовые тренажеры',
                        ),
                        array(
                            'title' => 'Велотренажеры',
                        ),
                        array(
                            'title' => 'Беговые дорожки',
                        ),
                        array(
                            'title' => 'Эллиптические тренажеры',
                        ),
                        array(
                            'title' => 'Другие тренажеры',
                        ),
                        array(
                            'title' => 'Степперы',
                        ),
                        array(
                            'title' => 'Гребные тренажеры',
                        )
                    )
                ),
                array(
                    'title' => 'Велосипеды',
                    'children' => array(
                        array(
                            'title' => 'Велосипеды',
                        ),
                        array(
                            'title' => 'Запчасти и аксессуары',
                        )
                    )
                ),
                array(
                    'title' => 'Охота и рыболовство',
                    'children' => array(
                        array(
                            'title' => 'Приманки',
                        ),
                        array(
                            'title' => 'Эхолоты',
                        ),
                        array(
                            'title' => 'Прицелы',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Спиннинги, удилища',
                        ),
                        array(
                            'title' => 'Катушки',
                        ),
                        array(
                            'title' => 'Экипировка',
                        ),
                        array(
                            'title' => 'Поплавки',
                        ),
                        array(
                            'title' => 'Леска и шнуры',
                        ),
                        array(
                            'title' => 'Пневматическое оружие',
                        ),
                        array(
                            'title' => 'Крючки',
                        ),
                        array(
                            'title' => 'Вертлюжки, застежки, поводки',
                        ),
                        array(
                            'title' => 'Грузила, джиг-головки',
                        ),
                        array(
                            'title' => 'Подсачеки',
                        ),
                        array(
                            'title' => 'Мормышки',
                        ),
                        array(
                            'title' => 'Прикормки',
                        )
                    )
                ),
                array(
                    'title' => 'Подводное плавание',
                    'children' => array(
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Гидрокостюмы и боты',
                        ),
                        array(
                            'title' => 'Регуляторы',
                        ),
                        array(
                            'title' => 'Компенсаторы плавучести',
                        ),
                        array(
                            'title' => 'Ласты',
                        ),
                        array(
                            'title' => 'Компрессоры и баллоны',
                        )
                    )
                ),
                array(
                    'title' => 'Сноубординг',
                    'children' => array(
                        array(
                            'title' => 'Сноуборды',
                        ),
                        array(
                            'title' => 'Крепления',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Ботинки',
                        )
                    )
                ),
                array(
                    'title' => 'Атлетика, фитнес',
                    'children' => array(
                        array(
                            'title' => 'Тяжелая атлетика',
                            'children' => array(
                                array(
                                    'title' => 'Гири, штанги и гантели',
                                )
                            )
                        ),
                        array(
                            'title' => 'Фитнес',
                        ),
                        array(
                            'title' => 'Легкая атлетика',
                        )
                    )
                ),
                array(
                    'title' => 'Горные лыжи',
                    'children' => array(
                        array(
                            'title' => 'Горные лыжи',
                        ),
                        array(
                            'title' => 'Ботинки',
                        ),
                        array(
                            'title' => 'Чехлы, сумки',
                        ),
                        array(
                            'title' => 'Крепления',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Палки',
                        )
                    )
                ),
                array(
                    'title' => 'Бильярд',
                    'children' => array(
                        array(
                            'title' => 'Столы',
                        ),
                        array(
                            'title' => 'Аксессуары для столов',
                            'children' => array(
                                array(
                                    'title' => 'Лампы',
                                ),
                                array(
                                    'title' => 'Плиты для столов',
                                ),
                                array(
                                    'title' => 'Сукно',
                                )
                            )
                        ),
                        array(
                            'title' => 'Аксессуары для игроков',
                            'children' => array(
                                array(
                                    'title' => 'Чехлы',
                                ),
                                array(
                                    'title' => 'Наклейки',
                                ),
                                array(
                                    'title' => 'Средства для ухода за кием',
                                )
                            )
                        ),
                        array(
                            'title' => 'Мебель для бильярдной',
                        ),
                        array(
                            'title' => 'Кии',
                            'children' => array(
                                array(
                                    'title' => 'Профессиональные',
                                ),
                                array(
                                    'title' => 'Специальные',
                                )
                            )
                        ),
                        array(
                            'title' => 'Шары',
                            'children' => array(
                                array(
                                    'title' => 'Русская пирамида',
                                ),
                                array(
                                    'title' => 'Пул',
                                )
                            )
                        )
                    )
                ),
                array(
                    'title' => 'Настольный теннис',
                    'children' => array(
                        array(
                            'title' => 'Столы',
                        ),
                        array(
                            'title' => 'Ракетки',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Сетки',
                        )
                    )
                ),
                array(
                    'title' => 'Лодки и плоты',
                    'children' => array(
                        array(
                            'title' => 'Лодки',
                        ),
                        array(
                            'title' => 'Лодочные моторы',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Яхты и катера',
                        ),
                        array(
                            'title' => 'Весла',
                        ),
                        array(
                            'title' => 'Плоты',
                        )
                    )
                ),
                array(
                    'title' => 'Бассейны и аксессуары',
                    'children' => array(
                        array(
                            'title' => 'Бассейны',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        )
                    )
                ),
                array(
                    'title' => 'Скейтбординг',
                    'children' => array(
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Скейтборды',
                        )
                    )
                ),
                array(
                    'title' => 'Альпинизм',
                ),
                array(
                    'title' => 'Бокс и единоборства',
                    'children' => array(
                        array(
                            'title' => 'Одежда и защита',
                        ),
                        array(
                            'title' => 'Тренировочные снаряды',
                        ),
                        array(
                            'title' => 'Перчатки',
                        ),
                        array(
                            'title' => 'Аксессуары и принадлежности',
                        )
                    )
                ),
                array(
                    'title' => 'Коньки',
                ),
                array(
                    'title' => 'Водный спорт',
                    'children' => array(
                        array(
                            'title' => 'Кайтсерфинг',
                        ),
                        array(
                            'title' => 'Водное поло',
                        ),
                        array(
                            'title' => 'Водные лыжи, вейкбординг и книбординг',
                        ),
                        array(
                            'title' => 'Виндсерфинг',
                            'children' => array(
                                array(
                                    'title' => 'Гидрокостюмы',
                                )
                            )
                        )
                    )
                ),
                array(
                    'title' => 'Дартс',
                ),
                array(
                    'title' => 'Спортинвентарь',
                ),
                array(
                    'title' => 'Роликовые коньки',
                    'children' => array(
                        array(
                            'title' => 'Роликовые коньки',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        )
                    )
                ),
                array(
                    'title' => 'Гимнастика',
                ),
                array(
                    'title' => 'Игровые столы',
                ),
                array(
                    'title' => 'Мячи',
                ),
                array(
                    'title' => 'Хоккей',
                ),
                array(
                    'title' => 'Баскетбол',
                ),
                array(
                    'title' => 'Санки и снегокаты',
                ),
                array(
                    'title' => 'Большой теннис',
                    'children' => array(
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Ракетки',
                        )
                    )
                ),
                array(
                    'title' => 'Волейбол',
                ),
                array(
                    'title' => 'Бадминтон',
                    'children' => array(
                        array(
                            'title' => 'Воланы',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Ракетки',
                        )
                    )
                ),
                array(
                    'title' => 'Беговые лыжи',
                    'children' => array(
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Беговые лыжи',
                        )
                    )
                ),
                array(
                    'title' => 'Бейсбол, городки',
                ),
                array(
                    'title' => 'Футбол',
                ),
                array(
                    'title' => 'Защита',
                ),
                array(
                    'title' => 'Пейнтбол',
                    'children' => array(
                        array(
                            'title' => 'Одежда и защита',
                        ),
                        array(
                            'title' => 'Аксессуары и принадлежности',
                        ),
                        array(
                            'title' => 'Стволы для маркеров',
                        )
                    )
                ),
                array(
                    'title' => 'Йога',
                ),
                array(
                    'title' => 'Сквош',
                    'children' => array(
                        array(
                            'title' => 'Аксессуары',
                        )
                    )
                ),
                array(
                    'title' => 'Сетки',
                )
            )
        ),
        array(
            'title' => 'Музыка и видеофильмы',
            'children' => array(
                array(
                    'title' => 'Музыка',
                    'children' => array(
                        array(
                            'title' => 'Другая музыка',
                        ),
                        array(
                            'title' => 'Классическая музыка',
                        ),
                        array(
                            'title' => 'Pop',
                        ),
                        array(
                            'title' => 'Jazz',
                        ),
                        array(
                            'title' => 'Alternative',
                        ),
                        array(
                            'title' => 'Авторская песня',
                        ),
                        array(
                            'title' => 'Classic rock',
                        ),
                        array(
                            'title' => 'Диски караоке',
                        ),
                        array(
                            'title' => 'Русский рок',
                        ),
                        array(
                            'title' => 'Blues',
                        ),
                        array(
                            'title' => 'Soundtracks',
                        ),
                        array(
                            'title' => 'Музыка для детей',
                        ),
                        array(
                            'title' => 'Heavy metal',
                        ),
                        array(
                            'title' => 'Rap',
                        ),
                        array(
                            'title' => 'Hard rock',
                        ),
                        array(
                            'title' => 'Фольклор',
                        ),
                        array(
                            'title' => 'Русская поп-музыка',
                        ),
                        array(
                            'title' => 'Электронная музыка',
                        ),
                        array(
                            'title' => 'Фолк, этника',
                        ),
                        array(
                            'title' => 'Disco',
                        ),
                        array(
                            'title' => 'Funk',
                        ),
                        array(
                            'title' => 'Русский джаз',
                        ),
                        array(
                            'title' => 'Rеggae',
                        ),
                        array(
                            'title' => 'Техно',
                        ),
                        array(
                            'title' => 'Latin',
                        ),
                        array(
                            'title' => 'Религиозная музыка',
                        ),
                        array(
                            'title' => 'Романсы',
                        )
                    )
                ),
                array(
                    'title' => 'Видеофильмы',
                    'children' => array(
                        array(
                            'title' => 'Мультфильмы',
                        ),
                        array(
                            'title' => 'Видеокурсы',
                        ),
                        array(
                            'title' => 'Драмы',
                        ),
                        array(
                            'title' => 'Мелодрамы',
                        ),
                        array(
                            'title' => 'Боевики',
                        ),
                        array(
                            'title' => 'Документальные фильмы',
                        ),
                        array(
                            'title' => 'Комедии',
                        ),
                        array(
                            'title' => 'Музыка',
                        ),
                        array(
                            'title' => 'Детективы',
                        ),
                        array(
                            'title' => 'Триллеры',
                        ),
                        array(
                            'title' => 'Детские фильмы',
                        ),
                        array(
                            'title' => 'Биографические фильмы',
                        ),
                        array(
                            'title' => 'Мистика и ужасы',
                        ),
                        array(
                            'title' => 'Фантастика',
                        ),
                        array(
                            'title' => 'Приключения',
                        ),
                        array(
                            'title' => 'Спорт',
                        ),
                        array(
                            'title' => 'Исторические фильмы',
                        ),
                        array(
                            'title' => 'Мюзиклы и театрализованные постановки',
                        ),
                        array(
                            'title' => 'Вестерны',
                        )
                    )
                ),
                array(
                    'title' => 'Музыкальные инструменты',
                    'children' => array(
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Электрогитары',
                        ),
                        array(
                            'title' => 'Ударные инструменты',
                        ),
                        array(
                            'title' => 'Акустические гитары',
                        ),
                        array(
                            'title' => 'Синтезаторы, цифровые пианино',
                        ),
                        array(
                            'title' => 'Духовые инструменты',
                        ),
                        array(
                            'title' => 'Микшерные пульты',
                        ),
                        array(
                            'title' => 'Бас-гитары',
                        ),
                        array(
                            'title' => 'Акустические пианино',
                        ),
                        array(
                            'title' => 'Смычковые инструменты',
                        )
                    )
                )
            )
        ),
        array(
            'title' => 'Аптека',
            'children' => array(
                array(
                    'title' => 'Медицинские приборы и изделия',
                    'children' => array(
                        array(
                            'title' => 'Диагностическое оборудование',
                            'children' => array(
                                array(
                                    'title' => 'Тонометры',
                                ),
                                array(
                                    'title' => 'Пульсометры',
                                ),
                                array(
                                    'title' => 'Термометры',
                                ),
                                array(
                                    'title' => 'Глюкометры',
                                ),
                                array(
                                    'title' => 'Жироанализаторы',
                                )
                            )
                        ),
                        array(
                            'title' => 'Ортопедические изделия',
                        ),
                        array(
                            'title' => 'Оборудование для медучреждений',
                        ),
                        array(
                            'title' => 'Костыли, трости, инвалидные кресла',
                        ),
                        array(
                            'title' => 'Медицинская мебель',
                        ),
                        array(
                            'title' => 'Ингаляторы, небулайзеры',
                        ),
                        array(
                            'title' => 'Грелки',
                        ),
                        array(
                            'title' => 'Шприцы, иглы',
                        ),
                        array(
                            'title' => 'Аптечки',
                        )
                    )
                ),
                array(
                    'title' => 'Оптика',
                    'children' => array(
                        array(
                            'title' => 'Солнцезащитные очки',
                        ),
                        array(
                            'title' => 'Контактные линзы',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Очки для коррекции зрения',
                        ),
                        array(
                            'title' => 'Линзы',
                        )
                    )
                ),
                array(
                    'title' => 'Витамины, минералы, пищевые добавки',
                ),
                array(
                    'title' => 'Лекарственные препараты',
                    'children' => array(
                        array(
                            'title' => 'Лекарственные растения',
                        ),
                        array(
                            'title' => 'Для лечения алкоголизма, наркомании, курения',
                        ),
                        array(
                            'title' => 'Дерматология и венерология',
                        ),
                        array(
                            'title' => 'Противовоспалительные, жаропонижающие',
                        ),
                        array(
                            'title' => 'Для лечения мочеполовой системы',
                        ),
                        array(
                            'title' => 'Иммуномодуляторы',
                        ),
                        array(
                            'title' => 'Гомеопатические',
                        ),
                        array(
                            'title' => 'Противомикробные и противовирусные',
                        ),
                        array(
                            'title' => 'Для лечения заболеваний нервной системы',
                        ),
                        array(
                            'title' => 'Для лечения желудочно-кишечных заболеваний',
                        ),
                        array(
                            'title' => 'Для лечения сердечно-сосудистых заболеваний',
                        ),
                        array(
                            'title' => 'Противоаллергические',
                        )
                    )
                ),
                array(
                    'title' => 'Лечебная одежда и обувь',
                ),
                array(
                    'title' => 'Беременной и кормящей женщине',
                ),
                array(
                    'title' => 'Средства по уходу за больными',
                ),
                array(
                    'title' => 'Медицинские материалы',
                    'children' => array(
                        array(
                            'title' => 'Пластыри',
                        ),
                        array(
                            'title' => 'Бинты',
                        ),
                        array(
                            'title' => 'Вата',
                        )
                    )
                ),
                array(
                    'title' => 'Текстиль с электроподогревом',
                    'children' => array(
                        array(
                            'title' => 'Электроодеяла',
                        ),
                        array(
                            'title' => 'Электропростыни',
                        ),
                        array(
                            'title' => 'Электроматрасы',
                        ),
                        array(
                            'title' => 'Электроподушки',
                        )
                    )
                ),
                array(
                    'title' => 'Диагностические тесты',
                ),
                array(
                    'title' => 'Интим-товары',
                    'children' => array(
                        array(
                            'title' => 'Косметика и парфюмерия',
                        )
                    )
                ),
                array(
                    'title' => 'Дезинфицирующие средства',
                ),
                array(
                    'title' => 'Контрацептивы',
                )
            )
        ),
        array(
            'title' => 'Компьютеры',
            'children' => array(
                array(
                    'title' => 'Программное обеспечение',
                    'children' => array(
                        array(
                            'title' => 'Игры для ПК',
                        ),
                        array(
                            'title' => 'Антивирусные программы',
                        ),
                        array(
                            'title' => 'Системы защиты',
                        ),
                        array(
                            'title' => 'Мультимедийные и обучающие пакеты',
                        ),
                        array(
                            'title' => 'Другое ПО',
                        ),
                        array(
                            'title' => 'Сетевое ПО',
                        ),
                        array(
                            'title' => 'Программирование',
                        ),
                        array(
                            'title' => 'Офисные программы',
                        ),
                        array(
                            'title' => 'Утилиты',
                        ),
                        array(
                            'title' => 'Словари и энциклопедии',
                        ),
                        array(
                            'title' => 'Верстка и дизайн',
                        ),
                        array(
                            'title' => 'Бухгалтерия и финансы',
                        ),
                        array(
                            'title' => 'Интернет программы',
                        ),
                        array(
                            'title' => 'Операционные системы',
                        ),
                        array(
                            'title' => 'Программы для КПК и сотовых телефонов',
                        ),
                        array(
                            'title' => 'СУБД',
                        ),
                        array(
                            'title' => 'CAD,CAM',
                        ),
                        array(
                            'title' => 'Программы для перевода',
                        ),
                        array(
                            'title' => 'Программы для организации коммерческой деят.',
                        ),
                        array(
                            'title' => 'Программы для Apple',
                        )
                    )
                ),
                array(
                    'title' => 'Комплектующие',
                    'children' => array(
                        array(
                            'title' => 'Модули памяти',
                        ),
                        array(
                            'title' => 'Жесткие диски',
                        ),
                        array(
                            'title' => 'Корпуса',
                        ),
                        array(
                            'title' => 'Видеокарты',
                        ),
                        array(
                            'title' => 'Материнские платы',
                        ),
                        array(
                            'title' => 'Вентиляторы и системы охлаждения',
                        ),
                        array(
                            'title' => 'Блоки питания',
                        ),
                        array(
                            'title' => 'Процессоры (CPU)',
                        ),
                        array(
                            'title' => 'Оптические приводы',
                        ),
                        array(
                            'title' => 'Накопители FDD, MOD, ZIP, Jazz, стримеры',
                        ),
                        array(
                            'title' => 'Звуковые карты',
                        ),
                        array(
                            'title' => 'Контроллеры',
                        ),
                        array(
                            'title' => 'Блоки питания для ноутбуков',
                        )
                    )
                ),
                array(
                    'title' => 'Сетевое оборудование',
                    'children' => array(
                        array(
                            'title' => 'Маршрутизаторы, коммутаторы, хабы',
                        ),
                        array(
                            'title' => 'Монтажное оборудование',
                        ),
                        array(
                            'title' => 'СКС',
                        ),
                        array(
                            'title' => 'Оборудование Wi-Fi и Bluetooth',
                        ),
                        array(
                            'title' => 'Сетевые камеры',
                        ),
                        array(
                            'title' => 'Системы доступа и коммуникационные сервера',
                        ),
                        array(
                            'title' => 'VoIP-оборудование',
                        ),
                        array(
                            'title' => 'Кабели и разъемы',
                        ),
                        array(
                            'title' => 'Модемы',
                        ),
                        array(
                            'title' => 'Беспроводное оборудование',
                        ),
                        array(
                            'title' => 'Конвертеры интерфейсов и скоростей',
                        ),
                        array(
                            'title' => 'Сетевые карты и адаптеры',
                        ),
                        array(
                            'title' => 'Трансиверы',
                        ),
                        array(
                            'title' => 'Принт-серверы',
                        ),
                        array(
                            'title' => 'Сетевые накопители',
                        ),
                        array(
                            'title' => 'Мультиплексоры',
                        ),
                        array(
                            'title' => 'Мосты',
                        )
                    )
                ),
                array(
                    'title' => 'Расходные материалы',
                    'children' => array(
                        array(
                            'title' => 'Картриджи, тонеры, фотобарабаны',
                        ),
                        array(
                            'title' => 'Бумага и пленка',
                        ),
                        array(
                            'title' => 'Дискеты, диски, кассеты',
                        ),
                        array(
                            'title' => 'Расходные материалы для кассовых аппаратов',
                        )
                    )
                ),
                array(
                    'title' => 'Ноутбуки',
                ),
                array(
                    'title' => 'Аксессуары',
                    'children' => array(
                        array(
                            'title' => 'Сумки и чехлы для ноутбуков',
                        ),
                        array(
                            'title' => 'Батареи и аккумуляторы',
                        ),
                        array(
                            'title' => 'Кабели, разъемы, переходники',
                        ),
                        array(
                            'title' => 'Аксессуары для принтеров и МФУ',
                        ),
                        array(
                            'title' => 'Аксессуары для КПК',
                        ),
                        array(
                            'title' => 'Фильтры и стабилизаторы',
                        ),
                        array(
                            'title' => 'Аксессуары для ноутбуков',
                        ),
                        array(
                            'title' => 'Защитные пленки для экранов',
                        ),
                        array(
                            'title' => 'Чистящие принадлежности',
                        ),
                        array(
                            'title' => 'Коврики и карманы для мышей',
                        ),
                        array(
                            'title' => 'Сумки и чехлы для КПК',
                        ),
                        array(
                            'title' => 'Футляры для дисков и дискет',
                        ),
                        array(
                            'title' => 'Кронштейны, держатели и подставки',
                        ),
                        array(
                            'title' => 'Инструменты',
                        ),
                        array(
                            'title' => 'USB-концентраторы',
                        )
                    )
                ),
                array(
                    'title' => 'Игровые приставки',
                    'children' => array(
                        array(
                            'title' => 'Игры',
                            'children' => array(
                                array(
                                    'title' => 'Игры для PlayStation 3',
                                ),
                                array(
                                    'title' => 'Игры для Xbox 360',
                                ),
                                array(
                                    'title' => 'Игры для PlayStation Portable',
                                ),
                                array(
                                    'title' => 'Игры для PlayStation 2',
                                ),
                                array(
                                    'title' => 'Игры для Wii',
                                ),
                                array(
                                    'title' => 'Игры для DS',
                                ),
                                array(
                                    'title' => 'Игры для Game Boy Advance',
                                ),
                                array(
                                    'title' => 'Игры для GameCube',
                                ),
                                array(
                                    'title' => 'Игры для Game Boy',
                                ),
                                array(
                                    'title' => 'Игры для Sega Mega Drive',
                                ),
                                array(
                                    'title' => 'Игры для Xbox',
                                ),
                                array(
                                    'title' => 'Игры для MegaDrive Portable',
                                )
                            )
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Игровые приставки',
                        )
                    )
                ),
                array(
                    'title' => 'Принтеры и МФУ',
                    'children' => array(
                        array(
                            'title' => 'Матричные принтеры',
                        ),
                        array(
                            'title' => 'Специальные принтеры',
                        )
                    )
                ),
                array(
                    'title' => 'Манипуляторы и клавиатуры',
                    'children' => array(
                        array(
                            'title' => 'Клавиатуры, мыши, комплекты',
                        ),
                        array(
                            'title' => 'Рули, джойстики, геймпады',
                        ),
                        array(
                            'title' => 'Планшеты и дигитайзеры',
                        ),
                        array(
                            'title' => 'Трекболы',
                        )
                    )
                ),
                array(
                    'title' => 'Мониторы',
                ),
                array(
                    'title' => 'Мультимедиа',
                    'children' => array(
                        array(
                            'title' => 'Компьютерная акустика',
                        ),
                        array(
                            'title' => 'Веб-камеры',
                        ),
                        array(
                            'title' => 'TV-тюнеры',
                        ),
                        array(
                            'title' => 'Миди-клавиатуры',
                        ),
                        array(
                            'title' => 'Оборудование для видеоконференций',
                        ),
                        array(
                            'title' => 'Микрофоны и наушники',
                        )
                    )
                ),
                array(
                    'title' => 'USB Flash drive',
                ),
                array(
                    'title' => 'Серверы',
                ),
                array(
                    'title' => 'Источники бесперебойного питания',
                ),
                array(
                    'title' => 'Карты памяти',
                ),
                array(
                    'title' => 'Настольные компьютеры',
                ),
                array(
                    'title' => 'Сканеры',
                ),
                array(
                    'title' => 'Устройства для чтения карт памяти',
                ),
                array(
                    'title' => 'КПК',
                ),
                array(
                    'title' => 'Режущие плоттеры',
                )
            )
        ),
        array(
            'title' => 'Одежда, обувь и аксессуары',
            'children' => array(
                array(
                    'title' => 'Одежда',
                    'children' => array(
                        array(
                            'title' => 'Женская одежда',
                        ),
                        array(
                            'title' => 'Спортивная одежда',
                        ),
                        array(
                            'title' => 'Мужская одежда',
                        ),
                        array(
                            'title' => 'Носки, чулки, колготки',
                        ),
                        array(
                            'title' => 'Женское нижнее белье и купальники',
                        ),
                        array(
                            'title' => 'Рабочая одежда',
                        ),
                        array(
                            'title' => 'Мужское нижнее и пляжное белье',
                        ),
                        array(
                            'title' => 'Шарфы, платки, палантины',
                        )
                    )
                ),
                array(
                    'title' => 'Галантерея',
                    'children' => array(
                        array(
                            'title' => 'Кошельки, обложки на документы, визитницы, ключницы',
                        ),
                        array(
                            'title' => 'Сумки, чемоданы, кейсы, портфели',
                        ),
                        array(
                            'title' => 'Зажигалки',
                        ),
                        array(
                            'title' => 'Ремни',
                        ),
                        array(
                            'title' => 'Брелоки',
                        ),
                        array(
                            'title' => 'Перчатки',
                        ),
                        array(
                            'title' => 'Косметички',
                        ),
                        array(
                            'title' => 'Галстуки',
                        ),
                        array(
                            'title' => 'Зонты',
                        )
                    )
                ),
                array(
                    'title' => 'Обувь',
                    'children' => array(
                        array(
                            'title' => 'Женская обувь',
                        ),
                        array(
                            'title' => 'Мужская обувь',
                        )
                    )
                ),
                array(
                    'title' => 'Головные уборы',
                ),
                array(
                    'title' => 'Сопутствующие товары',
                )
            )
        ),
        array(
            'title' => 'Мебель',
            'children' => array(
                array(
                    'title' => 'Мебель для дома',
                    'children' => array(
                        array(
                            'title' => 'Спальни',
                            'children' => array(
                                array(
                                    'title' => 'Матрасы',
                                ),
                                array(
                                    'title' => 'Основания для матрасов и наматрасники',
                                ),
                                array(
                                    'title' => 'Кровати',
                                ),
                                array(
                                    'title' => 'Комоды и тумбы',
                                ),
                                array(
                                    'title' => 'Прочая мебель для спальни',
                                ),
                                array(
                                    'title' => 'Спальные гарнитуры',
                                )
                            )
                        ),
                        array(
                            'title' => 'Мебель для ванных комнат',
                        ),
                        array(
                            'title' => 'Гостиные',
                        ),
                        array(
                            'title' => 'Мебель для кухни',
                        ),
                        array(
                            'title' => 'Шкафы',
                        ),
                        array(
                            'title' => 'Мягкая мебель',
                        ),
                        array(
                            'title' => 'Стулья',
                        ),
                        array(
                            'title' => 'Прихожие',
                        ),
                        array(
                            'title' => 'Письменные столы',
                        ),
                        array(
                            'title' => 'Стенки',
                        ),
                        array(
                            'title' => 'Столы',
                        )
                    )
                ),
                array(
                    'title' => 'Детская мебель',
                    'children' => array(
                        array(
                            'title' => 'Кроватки',
                        ),
                        array(
                            'title' => 'Стульчики для кормления',
                        ),
                        array(
                            'title' => 'Комоды',
                        ),
                        array(
                            'title' => 'Манежи',
                        ),
                        array(
                            'title' => 'Качели, шезлонги',
                        ),
                        array(
                            'title' => 'Ходунки, прыгунки',
                        ),
                        array(
                            'title' => 'Колыбели и люльки',
                        ),
                        array(
                            'title' => 'Пеленальные столики',
                        ),
                        array(
                            'title' => 'Шкафы',
                        )
                    )
                ),
                array(
                    'title' => 'Офисная мебель',
                    'children' => array(
                        array(
                            'title' => 'Шкафы и полки',
                        ),
                        array(
                            'title' => 'Кресла',
                        ),
                        array(
                            'title' => 'Готовые комплекты',
                        ),
                        array(
                            'title' => 'Столы для компьютеров',
                        ),
                        array(
                            'title' => 'Столы',
                        ),
                        array(
                            'title' => 'Стулья',
                        )
                    )
                ),
                array(
                    'title' => 'Походная мебель',
                ),
                array(
                    'title' => 'Садовая мебель',
                ),
                array(
                    'title' => 'Плетеная мебель',
                ),
                array(
                    'title' => 'Надувная мебель',
                )
            )
        ),
        array(
            'title' => 'Красота и здоровье',
            'children' => array(
                array(
                    'title' => 'Парфюмерия',
                    'children' => array(
                        array(
                            'title' => 'Парфюмерия женская',
                        ),
                        array(
                            'title' => 'Парфюмерия мужская',
                        ),
                        array(
                            'title' => 'Дезодоранты',
                        )
                    )
                ),
                array(
                    'title' => 'Средства по уходу за кожей',
                ),
                array(
                    'title' => 'Средства для волос',
                    'children' => array(
                        array(
                            'title' => 'Средства по уходу',
                        ),
                        array(
                            'title' => 'Средства для окрашивания',
                        ),
                        array(
                            'title' => 'Средства для укладки',
                        )
                    )
                ),
                array(
                    'title' => 'Маникюрные и педикюрные принадлежности',
                ),
                array(
                    'title' => 'Декоративная косметика',
                    'children' => array(
                        array(
                            'title' => 'Для лица',
                            'children' => array(
                                array(
                                    'title' => 'Тон и основа под макияж',
                                ),
                                array(
                                    'title' => 'Пудра',
                                ),
                                array(
                                    'title' => 'Румяна',
                                )
                            )
                        ),
                        array(
                            'title' => 'Для глаз',
                            'children' => array(
                                array(
                                    'title' => 'Тени для век',
                                ),
                                array(
                                    'title' => 'Тушь',
                                ),
                                array(
                                    'title' => 'Контур',
                                )
                            )
                        ),
                        array(
                            'title' => 'Лак для ногтей',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Для губ',
                        ),
                        array(
                            'title' => 'Косметические наборы',
                        )
                    )
                ),
                array(
                    'title' => 'Средства и предметы гигиены',
                    'children' => array(
                        array(
                            'title' => 'Мыло туалетное',
                        ),
                        array(
                            'title' => 'Бумажные средства гигиены',
                        ),
                        array(
                            'title' => 'Зубная паста, щетки, порошок, полоскание',
                        )
                    )
                ),
                array(
                    'title' => 'Парикмахерские принадлежности',
                ),
                array(
                    'title' => 'Массажеры',
                    'children' => array(
                        array(
                            'title' => 'Другие массажеры',
                        ),
                        array(
                            'title' => 'Массажные кресла',
                        ),
                        array(
                            'title' => 'Вибромассажеры',
                        ),
                        array(
                            'title' => 'Гидромассажеры',
                        )
                    )
                ),
                array(
                    'title' => 'Средства для бритья и депиляции',
                    'children' => array(
                        array(
                            'title' => 'Воски, кремы, лосьоны для депиляции',
                        ),
                        array(
                            'title' => 'Средства после бритья',
                        ),
                        array(
                            'title' => 'Бритвенные станки',
                        ),
                        array(
                            'title' => 'Пена, гель для бритья',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        )
                    )
                ),
                array(
                    'title' => 'Ароматерапия',
                ),
                array(
                    'title' => 'Средства для загара',
                ),
                array(
                    'title' => 'Приборы для ухода за телом и лицом',
                ),
                array(
                    'title' => 'Одежда для похудения / моделирующая одежда',
                ),
                array(
                    'title' => 'Миостимуляторы',
                ),
                array(
                    'title' => 'Солярии',
                ),
                array(
                    'title' => 'Косметические зеркала',
                )
            )
        ),
        array(
            'title' => 'Товары для детей',
            'children' => array(
                array(
                    'title' => 'Игрушки и спортивно-игровые комплексы',
                ),
                array(
                    'title' => 'Товары для малышей',
                    'children' => array(
                        array(
                            'title' => 'Коляски',
                        ),
                        array(
                            'title' => 'Автокресла',
                        ),
                        array(
                            'title' => 'Предметы для кормления',
                            'children' => array(
                                array(
                                    'title' => 'Бутылочки, пустышки, соски',
                                ),
                                array(
                                    'title' => 'Посуда',
                                ),
                                array(
                                    'title' => 'Подогреватели бутылочек',
                                ),
                                array(
                                    'title' => 'Стерилизаторы',
                                ),
                                array(
                                    'title' => 'Нагрудники и слюнявчики',
                                ),
                                array(
                                    'title' => 'Молокоотсосы',
                                ),
                                array(
                                    'title' => 'Поильники',
                                )
                            )
                        ),
                        array(
                            'title' => 'Детская косметика и гигиена',
                        ),
                        array(
                            'title' => 'Аксессуары для купания',
                        ),
                        array(
                            'title' => 'Спальные принадлежности и конверты',
                        ),
                        array(
                            'title' => 'Подгузники и пеленки',
                        ),
                        array(
                            'title' => 'Рюкзаки, сумки-кенгуру, переноски',
                        ),
                        array(
                            'title' => 'Радио- и видеоняни',
                        ),
                        array(
                            'title' => 'Защита и безопасность',
                        ),
                        array(
                            'title' => 'Аксессуары',
                            'children' => array(
                                array(
                                    'title' => 'Термометры',
                                )
                            )
                        ),
                        array(
                            'title' => 'Детские весы',
                        ),
                        array(
                            'title' => 'Горшки и сиденья',
                        )
                    )
                ),
                array(
                    'title' => 'Для школы',
                ),
                array(
                    'title' => 'Одежда для малышей',
                ),
                array(
                    'title' => 'Автомобили, самокаты',
                ),
                array(
                    'title' => 'Детская одежда',
                ),
                array(
                    'title' => 'Детская обувь',
                ),
                array(
                    'title' => 'Велосипеды для малышей',
                )
            )
        ),
        array(
            'title' => 'Все для дома и дачи',
            'children' => array(
                array(
                    'title' => 'Освещение',
                    'children' => array(
                        array(
                            'title' => 'Люстры',
                        ),
                        array(
                            'title' => 'Светильники',
                        ),
                        array(
                            'title' => 'Бра',
                        ),
                        array(
                            'title' => 'Настольные лампы',
                        ),
                        array(
                            'title' => 'Лампочки',
                        ),
                        array(
                            'title' => 'Торшеры',
                        ),
                        array(
                            'title' => 'Ночники',
                        ),
                        array(
                            'title' => 'Подсветка',
                        )
                    )
                ),
                array(
                    'title' => 'Кухонная посуда и принадлежности',
                    'children' => array(
                        array(
                            'title' => 'Столовая посуда',
                        ),
                        array(
                            'title' => 'Аксессуары для кухни',
                            'children' => array(
                                array(
                                    'title' => 'Наборы кухонных принадлежностей',
                                ),
                                array(
                                    'title' => 'Наборы для специй',
                                )
                            )
                        ),
                        array(
                            'title' => 'Посуда для готовки',
                        ),
                        array(
                            'title' => 'Ножи кухонные',
                        ),
                        array(
                            'title' => 'Столовые приборы',
                        ),
                        array(
                            'title' => 'Питьевое стекло',
                        ),
                        array(
                            'title' => 'Термосы',
                        ),
                        array(
                            'title' => 'Разделочные доски',
                        ),
                        array(
                            'title' => 'Турки, кофемолки',
                        ),
                        array(
                            'title' => 'Наборы для суши и риса',
                        ),
                        array(
                            'title' => 'Хлебницы и масленки',
                        ),
                        array(
                            'title' => 'Одноразовая посуда',
                        ),
                        array(
                            'title' => 'Фондю',
                        )
                    )
                ),
                array(
                    'title' => 'Дача, сад и огород',
                    'children' => array(
                        array(
                            'title' => 'Садовая техника',
                            'children' => array(
                                array(
                                    'title' => 'Газонокосилки',
                                ),
                                array(
                                    'title' => 'Культиваторы и мотоблоки',
                                ),
                                array(
                                    'title' => 'Минитракторы',
                                ),
                                array(
                                    'title' => 'Снегоуборщики',
                                ),
                                array(
                                    'title' => 'Вертикуттеры',
                                )
                            )
                        ),
                        array(
                            'title' => 'Мойки высокого давления',
                        ),
                        array(
                            'title' => 'Садовый инвентарь',
                        ),
                        array(
                            'title' => 'Фонтаны и пруды',
                        ),
                        array(
                            'title' => 'Оснастка к садовой технике',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Теплицы и парники',
                        ),
                        array(
                            'title' => 'Садовый декор',
                        ),
                        array(
                            'title' => 'Газоны',
                        ),
                        array(
                            'title' => 'Грили',
                        ),
                        array(
                            'title' => 'Посадочный материал',
                        )
                    )
                ),
                array(
                    'title' => 'Интерьер',
                    'children' => array(
                        array(
                            'title' => 'Элементы интерьера',
                        ),
                        array(
                            'title' => 'Часы',
                        ),
                        array(
                            'title' => 'Жалюзи',
                        ),
                        array(
                            'title' => 'Декоративные фонтаны',
                        ),
                        array(
                            'title' => 'Вазы',
                        ),
                        array(
                            'title' => 'Зеркала',
                        ),
                        array(
                            'title' => 'Карнизы',
                        ),
                        array(
                            'title' => 'Искусственное озеленение',
                        ),
                        array(
                            'title' => 'Ковры',
                        ),
                        array(
                            'title' => 'Стикеры',
                        )
                    )
                ),
                array(
                    'title' => 'Текстиль',
                    'children' => array(
                        array(
                            'title' => 'Постельное белье',
                        ),
                        array(
                            'title' => 'Шторы',
                        ),
                        array(
                            'title' => 'Подушки и одеяла',
                        ),
                        array(
                            'title' => 'Полотенца',
                        ),
                        array(
                            'title' => 'Пледы и покрывала',
                        )
                    )
                ),
                array(
                    'title' => 'Аксессуары для ванной и туалета',
                ),
                array(
                    'title' => 'Рукоделие',
                ),
                array(
                    'title' => 'Хозяйственный инвентарь',
                    'children' => array(
                        array(
                            'title' => 'Для уборки',
                        ),
                        array(
                            'title' => 'Гладильные доски',
                        ),
                        array(
                            'title' => 'Вешалки, плечики',
                        ),
                        array(
                            'title' => 'Ножницы',
                        ),
                        array(
                            'title' => 'Пакеты',
                        )
                    )
                ),
                array(
                    'title' => 'Бытовая химия',
                    'children' => array(
                        array(
                            'title' => 'Чистящие средства',
                        ),
                        array(
                            'title' => 'Стиральный порошок',
                        ),
                        array(
                            'title' => 'Моющие средства',
                        ),
                        array(
                            'title' => 'Освежители',
                        ),
                        array(
                            'title' => 'Средства против насекомых',
                        ),
                        array(
                            'title' => 'Отбеливатели',
                        )
                    )
                ),
                array(
                    'title' => 'Биотуалеты',
                ),
                array(
                    'title' => 'Скатерти',
                ),
                array(
                    'title' => 'Электроудлинители и переходники',
                ),
                array(
                    'title' => 'Почтовые ящики',
                ),
                array(
                    'title' => 'Звонки',
                ),
                array(
                    'title' => 'Ароматизаторы',
                )
            )
        ),
        array(
            'title' => 'Оборудование',
            'children' => array(
                array(
                    'title' => 'Системы охраны и сигнализации',
                    'children' => array(
                        array(
                            'title' => 'Системы видеонаблюдения',
                            'children' => array(
                                array(
                                    'title' => 'Видеокамеры',
                                ),
                                array(
                                    'title' => 'Готовые комплекты',
                                ),
                                array(
                                    'title' => 'Комплектующие',
                                ),
                                array(
                                    'title' => 'Видеорегистраторы',
                                ),
                                array(
                                    'title' => 'Карты видеонаблюдения',
                                )
                            )
                        ),
                        array(
                            'title' => 'Сигнализация',
                        ),
                        array(
                            'title' => 'Сейфы',
                        ),
                        array(
                            'title' => 'Системы контроля доступа',
                        ),
                        array(
                            'title' => 'Домофоны',
                        ),
                        array(
                            'title' => 'Замки и фурнитура',
                        ),
                        array(
                            'title' => 'Электропитание',
                        ),
                        array(
                            'title' => 'Регулировка движения',
                        ),
                        array(
                            'title' => 'ИК-прожекторы',
                        ),
                        array(
                            'title' => 'Системы безопасности',
                            'children' => array(
                                array(
                                    'title' => 'Противопожарная защита',
                                )
                            )
                        ),
                        array(
                            'title' => 'Средства самообороны',
                        )
                    )
                ),
                array(
                    'title' => 'Оборудование для магазинов',
                    'children' => array(
                        array(
                            'title' => 'Принтеры чеков, этикеток, штрих-кода',
                        ),
                        array(
                            'title' => 'Сканеры считывания штрих-кода',
                        ),
                        array(
                            'title' => 'Весы',
                        ),
                        array(
                            'title' => 'Осветительное оборудование',
                        ),
                        array(
                            'title' => 'Холодильное оборудование',
                        ),
                        array(
                            'title' => 'Кассовые аппараты',
                        ),
                        array(
                            'title' => 'Витрины',
                        ),
                        array(
                            'title' => 'Этикет-пистолеты',
                        ),
                        array(
                            'title' => 'Манекены',
                        )
                    )
                ),
                array(
                    'title' => 'Строительное оборудование',
                    'children' => array(
                        array(
                            'title' => 'Сварочное оборудование',
                        ),
                        array(
                            'title' => 'Измерительное оборудование',
                        ),
                        array(
                            'title' => 'Краны',
                        )
                    )
                ),
                array(
                    'title' => 'Световое и сценическое оборудование',
                ),
                array(
                    'title' => 'Банковское оборудование',
                    'children' => array(
                        array(
                            'title' => 'Счетчики купюр',
                        ),
                        array(
                            'title' => 'Детекторы валют',
                        ),
                        array(
                            'title' => 'Табло котировки валют',
                        ),
                        array(
                            'title' => 'Инкассаторское оборудование',
                        )
                    )
                ),
                array(
                    'title' => 'Воздушные компрессоры',
                ),
                array(
                    'title' => 'Станки',
                ),
                array(
                    'title' => 'Полиграфическое оборудование',
                    'children' => array(
                        array(
                            'title' => 'Расходные материалы',
                        )
                    )
                ),
                array(
                    'title' => 'Чистящая и моющая техника',
                    'children' => array(
                        array(
                            'title' => 'Профессиональные пылесосы',
                        ),
                        array(
                            'title' => 'Аксессуары и принадлежности',
                        ),
                        array(
                            'title' => 'Поломойные и подметальные машины',
                        ),
                        array(
                            'title' => 'Моющие средства',
                        )
                    )
                ),
                array(
                    'title' => 'Лабораторное оборудование',
                ),
                array(
                    'title' => 'Насосы промышленные',
                ),
                array(
                    'title' => 'Швейное производство',
                ),
                array(
                    'title' => 'Грузоподъемное оборудование',
                ),
                array(
                    'title' => 'Оборудование для автосервисов',
                ),
                array(
                    'title' => 'Для производства и тиражирования CD и DVD дисков',
                    'children' => array(
                        array(
                            'title' => 'Расходные материалы',
                        ),
                        array(
                            'title' => 'Дубликаторы',
                        ),
                        array(
                            'title' => 'CD/DVD принтеры и ламинаторы',
                        ),
                        array(
                            'title' => 'Анализаторы качества дисков',
                        ),
                        array(
                            'title' => 'Устройства хранения и уничтожения дисков',
                        )
                    )
                ),
                array(
                    'title' => 'Издательское оборудование',
                    'children' => array(
                        array(
                            'title' => 'Контрольно-измерительное оборудование',
                            'children' => array(
                                array(
                                    'title' => 'Устройства для цветокалибровки',
                                ),
                                array(
                                    'title' => 'Денситометры на отражение',
                                ),
                                array(
                                    'title' => 'Измерительное оборудование',
                                )
                            )
                        ),
                        array(
                            'title' => 'Проявочные машины',
                        ),
                        array(
                            'title' => 'Расходные материалы',
                        )
                    )
                ),
                array(
                    'title' => 'Упаковочное оборудование',
                    'children' => array(
                        array(
                            'title' => 'Для производства мягкой упаковки',
                        )
                    )
                ),
                array(
                    'title' => 'Производственно-техническое оборудование',
                ),
                array(
                    'title' => 'Пищевая промышленность',
                ),
                array(
                    'title' => 'Рекламные сувениры',
                )
            )
        ),
        array(
            'title' => 'Книги',
            'children' => array(
                array(
                    'title' => 'Литература на иностранных языках',
                    'children' => array(
                        array(
                            'title' => 'Английский язык',
                        ),
                        array(
                            'title' => 'Французский язык',
                        ),
                        array(
                            'title' => 'Немецкий язык',
                        ),
                        array(
                            'title' => 'Испанский язык',
                        )
                    )
                ),
                array(
                    'title' => 'Художественная литература',
                    'children' => array(
                        array(
                            'title' => 'Детективы, боевики, триллеры',
                        ),
                        array(
                            'title' => 'Зарубежная проза и поэзия',
                        ),
                        array(
                            'title' => 'Отечественная проза',
                        ),
                        array(
                            'title' => 'Сентиментальный роман',
                        ),
                        array(
                            'title' => 'Фантастика',
                        ),
                        array(
                            'title' => 'Фэнтези',
                        ),
                        array(
                            'title' => 'Биографии, мемуары, личности',
                        ),
                        array(
                            'title' => 'Исторический роман, приключения',
                        ),
                        array(
                            'title' => 'Поэзия',
                        ),
                        array(
                            'title' => 'Юмор и сатира',
                        ),
                        array(
                            'title' => 'Публицистика',
                        ),
                        array(
                            'title' => 'Фольклор, мифы, эпосы, сказания',
                        ),
                        array(
                            'title' => 'Античная литература',
                        ),
                        array(
                            'title' => 'Классическая литература',
                        )
                    )
                ),
                array(
                    'title' => 'Наука и образование',
                    'children' => array(
                        array(
                            'title' => 'Иностранные языки',
                        ),
                        array(
                            'title' => 'Психология',
                        ),
                        array(
                            'title' => 'История',
                        ),
                        array(
                            'title' => 'Педагогика',
                        ),
                        array(
                            'title' => 'Русский язык и литература',
                        ),
                        array(
                            'title' => 'Учебники для техникумов и вузов',
                        ),
                        array(
                            'title' => 'Учебники для школы',
                        ),
                        array(
                            'title' => 'Для дошкольников',
                        ),
                        array(
                            'title' => 'Религии',
                        ),
                        array(
                            'title' => 'Математика',
                        ),
                        array(
                            'title' => 'Философия',
                        ),
                        array(
                            'title' => 'Физика и астрономия',
                        ),
                        array(
                            'title' => 'Политология',
                        ),
                        array(
                            'title' => 'Военное дело',
                        ),
                        array(
                            'title' => 'Биология',
                        ),
                        array(
                            'title' => 'Социология',
                        ),
                        array(
                            'title' => 'Культурология',
                        ),
                        array(
                            'title' => 'Химия',
                        ),
                        array(
                            'title' => 'География и геология',
                        ),
                        array(
                            'title' => 'Средства массовой информации, журналистика',
                        ),
                        array(
                            'title' => 'Экология',
                        ),
                        array(
                            'title' => 'Для самообразования',
                        ),
                        array(
                            'title' => 'Карты и атласы',
                        ),
                        array(
                            'title' => 'Сельское хозяйство',
                        ),
                        array(
                            'title' => 'Риторика',
                        ),
                        array(
                            'title' => 'Логика',
                        ),
                        array(
                            'title' => 'Этика, эстетика',
                        )
                    )
                ),
                array(
                    'title' => 'Детская литература',
                    'children' => array(
                        array(
                            'title' => 'Раскраски, игры, загадки',
                        ),
                        array(
                            'title' => 'Сказки',
                        ),
                        array(
                            'title' => 'Для самых маленьких',
                        ),
                        array(
                            'title' => 'Детские энциклопедии',
                        ),
                        array(
                            'title' => 'Для дошкольников и младших классов',
                        ),
                        array(
                            'title' => 'Иностранные языки для детей',
                        ),
                        array(
                            'title' => 'Полезные советы',
                        )
                    )
                ),
                array(
                    'title' => 'Техническая литература',
                    'children' => array(
                        array(
                            'title' => 'Нормы и Госты',
                        ),
                        array(
                            'title' => 'Транспорт',
                            'children' => array(
                                array(
                                    'title' => 'Автомобили, мотоциклы',
                                ),
                                array(
                                    'title' => 'Водный транспорт',
                                ),
                                array(
                                    'title' => 'Авиация, космонавтика',
                                ),
                                array(
                                    'title' => 'Железнодорожный транспорт',
                                )
                            )
                        ),
                        array(
                            'title' => 'Промышленность, производство',
                        ),
                        array(
                            'title' => 'Строительство',
                        ),
                        array(
                            'title' => 'Военная техника, оружие',
                        ),
                        array(
                            'title' => 'Радиоаппаратура',
                        ),
                        array(
                            'title' => 'Техника',
                        ),
                        array(
                            'title' => 'Аудио, видео, фото, бытовая техника',
                        ),
                        array(
                            'title' => 'Энергетика',
                        ),
                        array(
                            'title' => 'Материаловедение',
                        ),
                        array(
                            'title' => 'Связь и телефония',
                        )
                    )
                ),
                array(
                    'title' => 'Дом, быт, семья, досуг',
                    'children' => array(
                        array(
                            'title' => 'Кулинария',
                        ),
                        array(
                            'title' => 'Спорт',
                        ),
                        array(
                            'title' => 'Рукоделие',
                        ),
                        array(
                            'title' => 'Сад, огород',
                        ),
                        array(
                            'title' => 'Игры и развлечения',
                        ),
                        array(
                            'title' => 'Красота и здоровье',
                        ),
                        array(
                            'title' => 'Животные',
                        ),
                        array(
                            'title' => 'Домашний мастер',
                        ),
                        array(
                            'title' => 'Ребенок и уход за ним',
                        ),
                        array(
                            'title' => 'Любовь и эротика',
                        ),
                        array(
                            'title' => 'Интерьер, дизайн',
                        ),
                        array(
                            'title' => 'Комнатные растения',
                        ),
                        array(
                            'title' => 'Коллекционирование',
                        ),
                        array(
                            'title' => 'Косметика и парфюмерия',
                        ),
                        array(
                            'title' => 'Мода',
                        )
                    )
                ),
                array(
                    'title' => 'Бизнес и экономика',
                    'children' => array(
                        array(
                            'title' => 'Менеджмент',
                        ),
                        array(
                            'title' => 'Экономика',
                        ),
                        array(
                            'title' => 'Маркетинг, реклама',
                        ),
                        array(
                            'title' => 'Бухгалтерский учет',
                        ),
                        array(
                            'title' => 'Торговля',
                        ),
                        array(
                            'title' => 'Финансы',
                        ),
                        array(
                            'title' => 'Налогообложение',
                        ),
                        array(
                            'title' => 'Управление персоналом',
                        ),
                        array(
                            'title' => 'Банковское дело',
                        ),
                        array(
                            'title' => 'Делопроизводство',
                        ),
                        array(
                            'title' => 'Аудит',
                        ),
                        array(
                            'title' => 'Страховое дело',
                        ),
                        array(
                            'title' => 'Ценные бумаги',
                        ),
                        array(
                            'title' => 'Недвижимость',
                        ),
                        array(
                            'title' => 'Статистика',
                        ),
                        array(
                            'title' => 'Работа',
                        ),
                        array(
                            'title' => 'Таможенное дело',
                        ),
                        array(
                            'title' => 'Валютные операции',
                        )
                    )
                ),
                array(
                    'title' => 'Медицина',
                    'children' => array(
                        array(
                            'title' => 'Литература для специалистов',
                        ),
                        array(
                            'title' => 'Народная и нетрадиционная медицина',
                        ),
                        array(
                            'title' => 'Правильное питание',
                        ),
                        array(
                            'title' => 'Беременность и уход за ребенком',
                        ),
                        array(
                            'title' => 'Ветеринария',
                        ),
                        array(
                            'title' => 'Фармакология',
                        ),
                        array(
                            'title' => 'Массаж',
                        )
                    )
                ),
                array(
                    'title' => 'Искусство и культура',
                    'children' => array(
                        array(
                            'title' => 'Музыка, ноты',
                        ),
                        array(
                            'title' => 'Изобразительное искусство',
                        ),
                        array(
                            'title' => 'Архитектура и зодчество',
                        ),
                        array(
                            'title' => 'Альбомы',
                        ),
                        array(
                            'title' => 'Антикварные и редкие книги',
                        ),
                        array(
                            'title' => 'Театр, кино, телевидение',
                        ),
                        array(
                            'title' => 'Фотоискусство',
                        ),
                        array(
                            'title' => 'Музеи и коллекции',
                        ),
                        array(
                            'title' => 'Творческие личности',
                        )
                    )
                ),
                array(
                    'title' => 'Эзотерика',
                    'children' => array(
                        array(
                            'title' => 'Эзотерика',
                        ),
                        array(
                            'title' => 'Астрология, гороскопы, гадания',
                        ),
                        array(
                            'title' => 'Магия, оккультизм, мистика',
                        ),
                        array(
                            'title' => 'Йога',
                        ),
                        array(
                            'title' => 'Фэн-шуй',
                        ),
                        array(
                            'title' => 'Парапсихология',
                        ),
                        array(
                            'title' => 'Восточные боевые искусства',
                        )
                    )
                ),
                array(
                    'title' => 'Словари, справочники, энциклопедии',
                    'children' => array(
                        array(
                            'title' => 'Словари и разговорники',
                        ),
                        array(
                            'title' => 'Путеводители',
                        ),
                        array(
                            'title' => 'Справочные издания',
                        ),
                        array(
                            'title' => 'Энциклопедии',
                        ),
                        array(
                            'title' => 'Руководства',
                        ),
                        array(
                            'title' => 'Толковые словари',
                        )
                    )
                ),
                array(
                    'title' => 'Юридическая литература',
                    'children' => array(
                        array(
                            'title' => 'Гражданское право',
                        ),
                        array(
                            'title' => 'Нормативные акты и документы',
                        ),
                        array(
                            'title' => 'Уголовное право',
                        ),
                        array(
                            'title' => 'Административное право',
                        ),
                        array(
                            'title' => 'Кодексы и комментарии',
                        ),
                        array(
                            'title' => 'Трудовое право',
                        ),
                        array(
                            'title' => 'Международное право',
                        ),
                        array(
                            'title' => 'Государственное право',
                        ),
                        array(
                            'title' => 'Жилищное, семейное право',
                        )
                    )
                ),
                array(
                    'title' => 'Компьютеры и интернет',
                    'children' => array(
                        array(
                            'title' => 'Графика, дизайн, CAD',
                        ),
                        array(
                            'title' => 'Литература для начинающих',
                        ),
                        array(
                            'title' => 'Языки программирования',
                        ),
                        array(
                            'title' => 'Интернет и локальные сети',
                        ),
                        array(
                            'title' => 'Операционные системы',
                        ),
                        array(
                            'title' => 'Программы для офиса',
                        ),
                        array(
                            'title' => 'Прикладные программные пакеты',
                        ),
                        array(
                            'title' => 'Базы данных',
                        ),
                        array(
                            'title' => 'Аппаратное обеспечение',
                        ),
                        array(
                            'title' => 'Программирование в интернет',
                        ),
                        array(
                            'title' => 'Игры',
                        )
                    )
                ),
                array(
                    'title' => 'Аудиокниги',
                ),
                array(
                    'title' => 'Журналы и газеты',
                    'children' => array(
                        array(
                            'title' => 'Спорт, туризм, отдых',
                        ),
                        array(
                            'title' => 'Наука и образование',
                        ),
                        array(
                            'title' => 'Компьютерная техника и ПО',
                        ),
                        array(
                            'title' => 'Интерьер',
                        ),
                        array(
                            'title' => 'Политика и экономика',
                        ),
                        array(
                            'title' => 'Красота и здоровье',
                        ),
                        array(
                            'title' => 'Авто, Мото',
                        )
                    )
                ),
                array(
                    'title' => 'Календари',
                )
            )
        ),
        array(
            'title' => 'Строительство и ремонт',
            'children' => array(
                array(
                    'title' => 'Сантехника',
                    'children' => array(
                        array(
                            'title' => 'Смесители',
                        ),
                        array(
                            'title' => 'Ванны',
                        ),
                        array(
                            'title' => 'Душевые кабины',
                        ),
                        array(
                            'title' => 'Трубы',
                            'children' => array(
                                array(
                                    'title' => 'Комплектующие',
                                ),
                                array(
                                    'title' => 'Канализационные',
                                ),
                                array(
                                    'title' => 'Водопроводные',
                                )
                            )
                        ),
                        array(
                            'title' => 'Кухонные мойки',
                        ),
                        array(
                            'title' => 'Унитазы, писсуары, биде',
                        ),
                        array(
                            'title' => 'Раковины, умывальники',
                        ),
                        array(
                            'title' => 'Душевые панели и гарнитуры',
                        ),
                        array(
                            'title' => 'Материалы для сан.тех. работ',
                        ),
                        array(
                            'title' => 'Бассейны и аксессуары',
                            'children' => array(
                                array(
                                    'title' => 'Бассейны',
                                ),
                                array(
                                    'title' => 'Аксессуары',
                                )
                            )
                        ),
                        array(
                            'title' => 'Элементы душевых кабин',
                        ),
                        array(
                            'title' => 'Сушилки для рук',
                        ),
                        array(
                            'title' => 'Системы инсталляции',
                        )
                    )
                ),
                array(
                    'title' => 'Инструменты',
                    'children' => array(
                        array(
                            'title' => 'Электроинструменты',
                            'children' => array(
                                array(
                                    'title' => 'Дрели и шуруповерты',
                                ),
                                array(
                                    'title' => 'Шлифовальные машины',
                                ),
                                array(
                                    'title' => 'Перфораторы',
                                ),
                                array(
                                    'title' => 'Лобзики',
                                ),
                                array(
                                    'title' => 'Фрезерные машины',
                                ),
                                array(
                                    'title' => 'Отбойники',
                                ),
                                array(
                                    'title' => 'Рубанки',
                                ),
                                array(
                                    'title' => 'Аккумуляторы',
                                ),
                                array(
                                    'title' => 'Ударные гайковерты',
                                ),
                                array(
                                    'title' => 'Пистолеты',
                                ),
                                array(
                                    'title' => 'Ножницы',
                                ),
                                array(
                                    'title' => 'Степлеры',
                                ),
                                array(
                                    'title' => 'Штроборезы',
                                ),
                                array(
                                    'title' => 'Краскопульты и аэрографы',
                                )
                            )
                        ),
                        array(
                            'title' => 'Ручной инструмент',
                            'children' => array(
                                array(
                                    'title' => 'Наборы инструментов',
                                ),
                                array(
                                    'title' => 'Молотки и кувалды',
                                ),
                                array(
                                    'title' => 'Отвертки',
                                ),
                                array(
                                    'title' => 'Тиски и струбцины',
                                ),
                                array(
                                    'title' => 'Зубила и керны',
                                ),
                                array(
                                    'title' => 'Ключи',
                                ),
                                array(
                                    'title' => 'Кабелерезы',
                                ),
                                array(
                                    'title' => 'Ножницы',
                                ),
                                array(
                                    'title' => 'Пилы',
                                ),
                                array(
                                    'title' => 'Стамески',
                                ),
                                array(
                                    'title' => 'Паяльники и паяльные лампы',
                                ),
                                array(
                                    'title' => 'Клещи и бокорезы',
                                ),
                                array(
                                    'title' => 'Напильники и надфили',
                                ),
                                array(
                                    'title' => 'Рубанки',
                                ),
                                array(
                                    'title' => 'Метчики и плашки',
                                ),
                                array(
                                    'title' => 'Пассатижи',
                                )
                            )
                        ),
                        array(
                            'title' => 'Оснастка к инструментам',
                            'children' => array(
                                array(
                                    'title' => 'Сверла',
                                ),
                                array(
                                    'title' => 'Буры',
                                ),
                                array(
                                    'title' => 'Отрезные круги',
                                ),
                                array(
                                    'title' => 'Бурильные коронки',
                                ),
                                array(
                                    'title' => 'Отбойные насадки',
                                ),
                                array(
                                    'title' => 'Отверточные насадки',
                                )
                            )
                        ),
                        array(
                            'title' => 'Пилы',
                        ),
                        array(
                            'title' => 'Измерительный инструмент',
                        ),
                        array(
                            'title' => 'Пневмоинструмент',
                        ),
                        array(
                            'title' => 'Стремянки',
                        ),
                        array(
                            'title' => 'Бензоинструмент',
                        )
                    )
                ),
                array(
                    'title' => 'Материалы',
                    'children' => array(
                        array(
                            'title' => 'Облицовочные и отделочные',
                            'children' => array(
                                array(
                                    'title' => 'Паркет',
                                ),
                                array(
                                    'title' => 'Ламинат',
                                ),
                                array(
                                    'title' => 'Линолеум',
                                ),
                                array(
                                    'title' => 'Ковровое покрытие',
                                ),
                                array(
                                    'title' => 'Обои',
                                ),
                                array(
                                    'title' => 'Панели ПВХ и МДФ',
                                ),
                                array(
                                    'title' => 'Керамическая плитка',
                                ),
                                array(
                                    'title' => 'Потолки',
                                ),
                                array(
                                    'title' => 'Сайдинг',
                                ),
                                array(
                                    'title' => 'Отделочный камень',
                                ),
                                array(
                                    'title' => 'Гипсокартон',
                                    'children' => array(
                                        array(
                                            'title' => 'Крепления и аксессуары для гипсокартона',
                                        )
                                    )
                                )
                            )
                        ),
                        array(
                            'title' => 'Лакокрасочные',
                            'children' => array(
                                array(
                                    'title' => 'Клей',
                                ),
                                array(
                                    'title' => 'Лаки',
                                ),
                                array(
                                    'title' => 'Грунтовки',
                                ),
                                array(
                                    'title' => 'Антисептики, морилки, пропитки',
                                ),
                                array(
                                    'title' => 'Краски',
                                ),
                                array(
                                    'title' => 'Краска для граффити',
                                ),
                                array(
                                    'title' => 'Растворители',
                                )
                            )
                        ),
                        array(
                            'title' => 'Элементы крепежа',
                            'children' => array(
                                array(
                                    'title' => 'Болты, шайбы, гайки',
                                ),
                                array(
                                    'title' => 'Винты, шурупы',
                                ),
                                array(
                                    'title' => 'Дюбеля',
                                ),
                                array(
                                    'title' => 'Анкерные болты',
                                ),
                                array(
                                    'title' => 'Гвозди',
                                )
                            )
                        ),
                        array(
                            'title' => 'Пиломатериалы',
                            'children' => array(
                                array(
                                    'title' => 'Плинтус',
                                ),
                                array(
                                    'title' => 'Вагонка',
                                ),
                                array(
                                    'title' => 'Древесноплитные материалы',
                                ),
                                array(
                                    'title' => 'Доска половая',
                                )
                            )
                        ),
                        array(
                            'title' => 'Стекло, стеклоизделия',
                        ),
                        array(
                            'title' => 'Кровельные и гидроизоляционные',
                            'children' => array(
                                array(
                                    'title' => 'Рулонные кровли',
                                ),
                                array(
                                    'title' => 'Гидроизоляция',
                                ),
                                array(
                                    'title' => 'Металлочерепица',
                                ),
                                array(
                                    'title' => 'Аксессуары',
                                ),
                                array(
                                    'title' => 'Мастики',
                                )
                            )
                        ),
                        array(
                            'title' => 'Металлический прокат, арматура, опалубка',
                        ),
                        array(
                            'title' => 'Для производства рекламных конструкций',
                        ),
                        array(
                            'title' => 'Тепло- и шумоизоляция',
                            'children' => array(
                                array(
                                    'title' => 'Шумоизоляционные материалы',
                                ),
                                array(
                                    'title' => 'Теплоизоляционные материалы',
                                ),
                                array(
                                    'title' => 'Аксессуары',
                                ),
                                array(
                                    'title' => 'Теплошумоизоляционные материалы',
                                )
                            )
                        ),
                        array(
                            'title' => 'Сыпучие и вяжущие материалы и смеси',
                            'children' => array(
                                array(
                                    'title' => 'Герметики',
                                ),
                                array(
                                    'title' => 'Сухие смеси',
                                    'children' => array(
                                        array(
                                            'title' => 'Шпатлевки',
                                        ),
                                        array(
                                            'title' => 'Цемент, пескобетон, наполнители',
                                        )
                                    )
                                )
                            )
                        ),
                        array(
                            'title' => 'Кирпич, бетон, пеноблоки',
                        ),
                        array(
                            'title' => 'Железобетонные изделия',
                        )
                    )
                ),
                array(
                    'title' => 'Электрика',
                    'children' => array(
                        array(
                            'title' => 'Электростанции',
                        ),
                        array(
                            'title' => 'Стабилизаторы напряжения',
                        ),
                        array(
                            'title' => 'Розетки',
                        ),
                        array(
                            'title' => 'Измерительное оборудование',
                        ),
                        array(
                            'title' => 'Автоматические выключатели',
                        ),
                        array(
                            'title' => 'Провода, кабели',
                        ),
                        array(
                            'title' => 'Щиты и шкафы',
                        ),
                        array(
                            'title' => 'Выключатели и переключатели',
                        ),
                        array(
                            'title' => 'Дифференциальные автоматы',
                        ),
                        array(
                            'title' => 'Трансформаторы',
                        ),
                        array(
                            'title' => 'Предохранители',
                        ),
                        array(
                            'title' => 'Устройства защитного отключения',
                        ),
                        array(
                            'title' => 'Аккумуляторные батареи',
                        ),
                        array(
                            'title' => 'Автотрансформаторы',
                        ),
                        array(
                            'title' => 'Счетчики',
                        )
                    )
                ),
                array(
                    'title' => 'Отопление',
                    'children' => array(
                        array(
                            'title' => 'Радиаторы',
                        ),
                        array(
                            'title' => 'Элементы систем отопления',
                        ),
                        array(
                            'title' => 'Отопительные системы',
                        ),
                        array(
                            'title' => 'Полотенцесушители',
                        ),
                        array(
                            'title' => 'Теплый пол',
                        ),
                        array(
                            'title' => 'Камины',
                        ),
                        array(
                            'title' => 'Аксессуары и порталы для каминов',
                        )
                    )
                ),
                array(
                    'title' => 'Насосы',
                ),
                array(
                    'title' => 'Лестницы',
                ),
                array(
                    'title' => 'Двери и ворота',
                    'children' => array(
                        array(
                            'title' => 'Двери',
                        ),
                        array(
                            'title' => 'Замки, щеколды, защелки',
                        ),
                        array(
                            'title' => 'Ручки дверные',
                        ),
                        array(
                            'title' => 'Петли дверные',
                        )
                    )
                ),
                array(
                    'title' => 'Вентиляция',
                ),
                array(
                    'title' => 'Сауны и бани',
                    'children' => array(
                        array(
                            'title' => 'Печи',
                        ),
                        array(
                            'title' => 'Инфракрасные сауны',
                        ),
                        array(
                            'title' => 'Парогенераторы',
                        ),
                        array(
                            'title' => 'Сауны и бани',
                        )
                    )
                ),
                array(
                    'title' => 'Средства индивидуальной защиты',
                ),
                array(
                    'title' => 'Окна',
                ),
                array(
                    'title' => 'Проекты домов',
                ),
                array(
                    'title' => 'Готовые конструкции',
                    'children' => array(
                        array(
                            'title' => 'Садовые домики',
                        )
                    )
                ),
                array(
                    'title' => 'Элементы лестниц',
                )
            )
        ),
        array(
            'title' => 'Авто, мото',
            'children' => array(
                array(
                    'title' => 'Колесные диски',
                ),
                array(
                    'title' => 'Шины',
                ),
                array(
                    'title' => 'Аудио- и видеотехника',
                    'children' => array(
                        array(
                            'title' => 'Автоакустика',
                        ),
                        array(
                            'title' => 'Автомагнитолы',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Усилители',
                        ),
                        array(
                            'title' => 'Телевизоры и мониторы',
                        ),
                        array(
                            'title' => 'Антенны',
                        ),
                        array(
                            'title' => 'FM -трансмиттеры',
                        ),
                        array(
                            'title' => 'Акустические полки, короба и подиумы',
                        ),
                        array(
                            'title' => 'Чейнджеры',
                        )
                    )
                ),
                array(
                    'title' => 'Запчасти',
                    'children' => array(
                        array(
                            'title' => 'Фары',
                        ),
                        array(
                            'title' => 'Подвеска',
                        ),
                        array(
                            'title' => 'Двигатель',
                        ),
                        array(
                            'title' => 'Кузов',
                        ),
                        array(
                            'title' => 'Электрика',
                        ),
                        array(
                            'title' => 'Топливная система',
                        ),
                        array(
                            'title' => 'Тормозная система',
                        ),
                        array(
                            'title' => 'Трансмиссия',
                        ),
                        array(
                            'title' => 'Привод',
                        ),
                        array(
                            'title' => 'Топливные фильтры',
                        ),
                        array(
                            'title' => 'Рулевое управление',
                        ),
                        array(
                            'title' => 'Аккумуляторные батареи',
                        ),
                        array(
                            'title' => 'Система выпуска',
                        ),
                        array(
                            'title' => 'Масляные фильтры',
                        ),
                        array(
                            'title' => 'Фаркопы',
                        ),
                        array(
                            'title' => 'Стекла',
                        ),
                        array(
                            'title' => 'Воздушные фильтры',
                        ),
                        array(
                            'title' => 'Пластик и резина',
                        ),
                        array(
                            'title' => 'Тросы',
                        ),
                        array(
                            'title' => 'Салон',
                        ),
                        array(
                            'title' => 'Омыватель',
                        )
                    )
                ),
                array(
                    'title' => 'Аксессуары',
                    'children' => array(
                        array(
                            'title' => 'Защита',
                            'children' => array(
                                array(
                                    'title' => 'Защита картера',
                                ),
                                array(
                                    'title' => 'Защита бампера',
                                ),
                                array(
                                    'title' => 'Дефлекторы',
                                ),
                                array(
                                    'title' => 'Защита фар',
                                ),
                                array(
                                    'title' => 'Подкрылки',
                                )
                            )
                        ),
                        array(
                            'title' => 'Ксенон',
                        ),
                        array(
                            'title' => 'Коврики',
                        ),
                        array(
                            'title' => 'Автомобильные зарядные устройства',
                        ),
                        array(
                            'title' => 'Автомобильные видеорегистраторы',
                        ),
                        array(
                            'title' => 'Радар-детекторы',
                        ),
                        array(
                            'title' => 'Парковочные радары',
                        ),
                        array(
                            'title' => 'Стеклоочистители',
                        ),
                        array(
                            'title' => 'Автомобильные холодильники',
                        ),
                        array(
                            'title' => 'Подсветка',
                        ),
                        array(
                            'title' => 'Бортовые компьютеры',
                        ),
                        array(
                            'title' => 'Внешний декор',
                        ),
                        array(
                            'title' => 'Освежители воздуха',
                        ),
                        array(
                            'title' => 'Багажники',
                        ),
                        array(
                            'title' => 'Тюнинг-комплекты',
                        ),
                        array(
                            'title' => 'Зеркала заднего вида',
                        ),
                        array(
                            'title' => 'Насосы',
                        ),
                        array(
                            'title' => 'Чехлы на сидения',
                        ),
                        array(
                            'title' => 'Щетки и скребки',
                        ),
                        array(
                            'title' => 'Ручки КПП',
                        ),
                        array(
                            'title' => 'Сигналы',
                        ),
                        array(
                            'title' => 'Рули',
                        ),
                        array(
                            'title' => 'Автоаптечки',
                        ),
                        array(
                            'title' => 'Огнетушители',
                        ),
                        array(
                            'title' => 'Тенты для автомобиля',
                        )
                    )
                ),
                array(
                    'title' => 'Противоугонные устройства',
                    'children' => array(
                        array(
                            'title' => 'Автосигнализации',
                        ),
                        array(
                            'title' => 'Механические блокираторы',
                        ),
                        array(
                            'title' => 'Иммобилайзеры',
                        ),
                        array(
                            'title' => 'Противоугонные комплексы',
                        ),
                        array(
                            'title' => 'Автопейджеры',
                        )
                    )
                ),
                array(
                    'title' => 'Автохимия',
                    'children' => array(
                        array(
                            'title' => 'Моторные масла',
                        ),
                        array(
                            'title' => 'Присадки в топливо',
                        ),
                        array(
                            'title' => 'Антифризы',
                        ),
                        array(
                            'title' => 'Герметики',
                        ),
                        array(
                            'title' => 'Тормозные жидкости',
                        ),
                        array(
                            'title' => 'Смазки',
                        ),
                        array(
                            'title' => 'Антикоры',
                        ),
                        array(
                            'title' => 'Присадки в масло',
                        ),
                        array(
                            'title' => 'Промывки и промывочное масло',
                        )
                    )
                ),
                array(
                    'title' => 'Грузовые машины',
                    'children' => array(
                        array(
                            'title' => 'Шасси',
                        ),
                        array(
                            'title' => 'Самосвалы',
                        ),
                        array(
                            'title' => 'Седельные тягачи',
                        ),
                        array(
                            'title' => 'Полуприцепы',
                        ),
                        array(
                            'title' => 'Бортовые',
                        ),
                        array(
                            'title' => 'Прицепы',
                        ),
                        array(
                            'title' => 'Лесовозы',
                        )
                    )
                ),
                array(
                    'title' => 'Инструменты',
                ),
                array(
                    'title' => 'Устройства громкой связи',
                ),
                array(
                    'title' => 'Автокосметика',
                    'children' => array(
                        array(
                            'title' => 'Полироли',
                        ),
                        array(
                            'title' => 'Очистители',
                        ),
                        array(
                            'title' => 'Автошампуни',
                        ),
                        array(
                            'title' => 'Автоэмали',
                        ),
                        array(
                            'title' => 'Нанопокрытия',
                        ),
                        array(
                            'title' => 'Грунтовка',
                        )
                    )
                ),
                array(
                    'title' => 'Спецтехника',
                    'children' => array(
                        array(
                            'title' => 'Автобетоносмесители',
                        ),
                        array(
                            'title' => 'Коммунальная техника',
                        ),
                        array(
                            'title' => 'Автокраны',
                        ),
                        array(
                            'title' => 'Погрузчики',
                        ),
                        array(
                            'title' => 'Экскаваторы',
                        ),
                        array(
                            'title' => 'Бульдозеры',
                        )
                    )
                ),
                array(
                    'title' => 'Мототехника',
                    'children' => array(
                        array(
                            'title' => 'Скутеры',
                        ),
                        array(
                            'title' => 'Мотоциклы',
                        )
                    )
                )
            )
        ),
        array(
            'title' => 'Электроника и Фото',
            'children' => array(
                array(
                    'title' => 'Аудиотехника',
                    'children' => array(
                        array(
                            'title' => 'Акустические системы',
                        ),
                        array(
                            'title' => 'Усилители и ресиверы',
                        ),
                        array(
                            'title' => 'MD и CD-проигрыватели',
                        ),
                        array(
                            'title' => 'Музыкальные центры',
                        ),
                        array(
                            'title' => 'Комплекты акустики',
                        ),
                        array(
                            'title' => 'Микрофоны',
                        ),
                        array(
                            'title' => 'Проигрыватели виниловых дисков и аксессуары',
                        ),
                        array(
                            'title' => 'Тюнеры, эквалайзеры',
                        ),
                        array(
                            'title' => 'Системы караоке',
                        ),
                        array(
                            'title' => 'Деки кассетные',
                        )
                    )
                ),
                array(
                    'title' => 'Аксессуары',
                    'children' => array(
                        array(
                            'title' => 'Кабели и разъемы',
                        ),
                        array(
                            'title' => 'Подставки и кронштейны',
                        ),
                        array(
                            'title' => 'Батарейки и аккумуляторы',
                        ),
                        array(
                            'title' => 'Аксессуары для видеокамер',
                        ),
                        array(
                            'title' => 'Универсальные пульты ДУ',
                        ),
                        array(
                            'title' => 'Аксессуары для устройств чтения электронных книг',
                        ),
                        array(
                            'title' => 'Аксессуары для цифровых плееров',
                        )
                    )
                ),
                array(
                    'title' => 'Фото',
                    'children' => array(
                        array(
                            'title' => 'Аксессуары',
                            'children' => array(
                                array(
                                    'title' => 'Сумки, чехлы',
                                ),
                                array(
                                    'title' => 'Источники питания, зарядные устройства',
                                ),
                                array(
                                    'title' => 'Светофильтры',
                                ),
                                array(
                                    'title' => 'Насадки и крышки на объективы',
                                ),
                                array(
                                    'title' => 'Адаптеры и переходные кольца',
                                ),
                                array(
                                    'title' => 'Дистанционное управление',
                                ),
                                array(
                                    'title' => 'Аксессуары для фотовспышек',
                                )
                            )
                        ),
                        array(
                            'title' => 'Цифровые фотоаппараты',
                        ),
                        array(
                            'title' => 'Объективы',
                        ),
                        array(
                            'title' => 'Штативы и моноподы',
                        ),
                        array(
                            'title' => 'Оборудование для профессионалов',
                        ),
                        array(
                            'title' => 'Цифровые фоторамки и фотоальбомы',
                        ),
                        array(
                            'title' => 'Фотовспышки',
                        ),
                        array(
                            'title' => 'Оборудование для подводной съемки',
                        ),
                        array(
                            'title' => 'Фотоматериалы и химикаты',
                        ),
                        array(
                            'title' => 'Измерительное оборудование',
                        ),
                        array(
                            'title' => 'Цифровые фотобанки',
                        ),
                        array(
                            'title' => 'Зеркальные пленочные фотоаппараты',
                        ),
                        array(
                            'title' => 'Лабораторное оборудование',
                        )
                    )
                ),
                array(
                    'title' => 'Портативная аудиотехника',
                    'children' => array(
                        array(
                            'title' => 'Наушники',
                        ),
                        array(
                            'title' => 'Цифровые плееры',
                        ),
                        array(
                            'title' => 'Диктофоны',
                        ),
                        array(
                            'title' => 'Магнитолы',
                        ),
                        array(
                            'title' => 'Радиоприемники',
                        ),
                        array(
                            'title' => 'Портативная акустика',
                        )
                    )
                ),
                array(
                    'title' => 'Телевизоры и плазменные панели',
                ),
                array(
                    'title' => 'DVD и Blu-ray плееры',
                ),
                array(
                    'title' => 'GPS-навигаторы',
                    'children' => array(
                        array(
                            'title' => 'GPS-навигаторы',
                        ),
                        array(
                            'title' => 'Аксессуары',
                        ),
                        array(
                            'title' => 'Карты и программы GPS-навигации',
                        )
                    )
                ),
                array(
                    'title' => 'Видеокамеры',
                ),
                array(
                    'title' => 'Оптические приборы',
                    'children' => array(
                        array(
                            'title' => 'Бинокли и подзорные трубы',
                        ),
                        array(
                            'title' => 'Телескопы',
                        ),
                        array(
                            'title' => 'Микроскопы',
                        ),
                        array(
                            'title' => 'Приборы ночного видения',
                        ),
                        array(
                            'title' => 'Лупы',
                        )
                    )
                ),
                array(
                    'title' => 'Стационарные медиаплееры',
                ),
                array(
                    'title' => 'Домашние кинотеатры',
                ),
                array(
                    'title' => 'Устройства для чтения электронных книг',
                ),
                array(
                    'title' => 'Радиостанции',
                ),
                array(
                    'title' => 'Спутниковое и кабельное телевидение',
                ),
                array(
                    'title' => 'Карманные электронные устройства',
                    'children' => array(
                        array(
                            'title' => 'Словари и переводчики',
                        ),
                        array(
                            'title' => 'Записные книжки',
                        )
                    )
                ),
                array(
                    'title' => 'Системы MultiRoom',
                ),
                array(
                    'title' => 'Кассеты и диски',
                ),
                array(
                    'title' => 'Видеомагнитофоны',
                )
            )
        )
    );

  }
}
