@if ($notification->booking && $notification->booking->status === 'approved')
<x-notifications.booking-approved-notification :notification="$notification" />
@elseif ($notification->booking && $notification->booking->status === 'cancelled')
<x-notifications.booking-cancelled-notification :notification="$notification" />
@else
<x-notifications.information-notification :notification="$notification" />
@endif
