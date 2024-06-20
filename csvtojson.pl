#!/usr/env perl

use common::sense;

use FindBin      qw($Script);
use JSON::XS;
use Path::Tiny;
use Text::CSV_XS qw(csv); 
use Getopt::Long;

my $help;
my $file;
GetOptions('help' => \$help, 'file=s' => \$file);

if ($help || not defined $file)
{
    die "Usage: $Script --file=";
}

my $dataset = csv (in => $file, headers => "auto");

path('Mobile_Food_Facility_Permit.json')->spew( encode_json({'data' => $dataset}));

print "END\n";
__END__