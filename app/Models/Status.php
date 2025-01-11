<?php

enum status: string {
    case NotStarted = 'Niet gestart';
    case InProgress = 'In uitvoering';
    case Completed = 'Voltooit';
    case OnHold = 'In de wacht';
}
