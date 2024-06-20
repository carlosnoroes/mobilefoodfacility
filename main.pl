#!/usr/env perl

use common::sense;

use FindBin      qw($Script);
use Path::Tiny;
use Text::CSV_XS qw(csv); 
use Getopt::Long;

my $help;

GetOptions(my $search = {} , 'filter=s%', 'help' => \$help);

if ($help || keys %{$search} == 0)
{
    die "Usage: $Script --filter Address=\"Block\" --filter FoodItems=\"fruit\"";
}

use DDP;

my $CSV_FILE = 'Mobile_Food_Facility_Permit.csv';

my ($header) = path($CSV_FILE)->lines( { count => 1 } ); 
chomp $header;
my @fields = split ',' , $header;

my $filter; 

foreach my $k ( keys %{$search->{'filter'}} )
{
    next if not defined $k;

    my $value = $search->{'filter'}{$k}; p $value; p $k;
    $filter->{$k} = sub { $_ =~ /$value/ }
}

my $dataset = csv (in => $CSV_FILE, headers => "auto", filter => $filter );

p $dataset;
__END__