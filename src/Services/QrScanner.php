<?php
namespace Services\QrScanner\Services;

final class QrScanner
{
    public function scan(string $payload): array
    {
        $ticketId = $this->extractTicketId($payload);
        return [
            'valid' => (bool) $ticketId,
            'ticket_id' => $ticketId,
            'meta' => ['source'=>'qr-package','payload_len'=>strlen($payload)],
        ];
    }

    private function extractTicketId(string $payload): ?string
    {
        $j = json_decode($payload, true);
        if (is_array($j) && !empty($j['ticket_id'])) return $j['ticket_id'];
        return preg_match('/^[a-f0-9-]{8,}$/i',$payload) ? $payload : null;
    }
}
