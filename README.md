MiniCalendar
============

Nette component for fast creating mini calendar.

Use in factory
--------------

    $control = new \NRomiix\Components\MiniCalendar;
    $control->addDayOfTheWeek("Dnes je %s");
    $control->addDayFrom("Csv"," <i>(%s)</i>","public.sk.csv");
    $control->addDate(", %s","j.n.Y. ");
    $control->addDayFrom("Csv","Meniny má %s. ","name_day.sk.csv");
    $control->addDayFrom("Csv","Zajtra má meniny %s. ","name_day.sk.csv","+1 day");
    return $control;

Format of CSV files
-------------------

If is option year empty, option is ignored.
If is value different from the current year, file is ignored.
